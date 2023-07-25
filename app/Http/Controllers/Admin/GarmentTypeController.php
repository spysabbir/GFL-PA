<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GarmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GarmentTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = GarmentType::select('garment_types.*');

            if ($request->status) {
                $query->where('garment_types.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $garment_types = $query->get();

            return DataTables::of($garment_types)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'Active') {
                        $status = '<span class="badge text-white bg-green">' . $row->status . '</span>
                                   <button type="button" data-id="' . $row->id . '" class="btn text-white bg-green btn-sm statusBtn"><i class="fe fe-check"></i></button>';
                    } else {
                        $status = '<span class="badge text-white bg-orange">' . $row->status . '</span>
                                   <button type="button" data-id="' . $row->id . '" class="btn text-white bg-orange btn-sm statusBtn"><i class="fe fe-slash"></i></button>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.garment_type.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255|unique:garment_types,item_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            GarmentType::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $garment_type = GarmentType::where('id', $id)->first();
        return response()->json($garment_type);
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255|unique:garment_types,item_name,' . $id,

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $garment_type = GarmentType::findOrFail($id);
            $garment_type->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $garment_type = GarmentType::findOrFail($id);
        $garment_type->updated_by = Auth::user()->id;
        $garment_type->deleted_by = Auth::user()->id;
        $garment_type->save();
        $garment_type->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_garment_types = GarmentType::onlyTrashed();

            $trashed_garment_types->orderBy('deleted_at', 'desc');

            return DataTables::of($trashed_garment_types)
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" data-id="'.$row->id.'" class="btn text-white bg-lime restoreBtn"><i class="fe fe-refresh-ccw"></i></button>
                        <button type="button" data-id="'.$row->id.'" class="btn text-white bg-red forceDeleteBtn"><i class="fe fe-delete"></i></button>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.garment_type.index');
    }

    public function restore(string $id)
    {
        GarmentType::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        GarmentType::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $garment_type = GarmentType::onlyTrashed()->where('id', $id)->first();
        $garment_type->forceDelete();
    }

    public function status(string $id)
    {
        $garment_type = GarmentType::findOrFail($id);

        if ($garment_type->status == "Active") {
            $garment_type->status = "Inactive";
        } else {
            $garment_type->status = "Active";
        }

        $garment_type->updated_by = Auth::user()->id;
        $garment_type->save();
    }
}
