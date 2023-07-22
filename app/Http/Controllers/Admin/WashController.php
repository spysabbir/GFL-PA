<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WashController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Wash::select('washes.*');

            if ($request->status) {
                $query->where('washes.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $washes = $query->get();

            return DataTables::of($washes)
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

        return view('admin.wash.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wash_name' => 'required|string|max:255|unique:washes,wash_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Wash::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $wash = Wash::where('id', $id)->first();
        return response()->json($wash);
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'wash_name' => 'required|string|max:255|unique:washes,wash_name,' . $id,

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $wash = Wash::findOrFail($id);
            $wash->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $wash = Wash::findOrFail($id);
        $wash->updated_by = Auth::user()->id;
        $wash->deleted_by = Auth::user()->id;
        $wash->save();
        $wash->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_washes = Wash::onlyTrashed();

            $trashed_washes->orderBy('deleted_at', 'desc');

            return DataTables::of($trashed_washes)
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

        return view('admin.wash.index');
    }

    public function restore(string $id)
    {
        Wash::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Wash::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $wash = Wash::onlyTrashed()->where('id', $id)->first();
        $wash->forceDelete();
    }

    public function status(string $id)
    {
        $wash = Wash::findOrFail($id);

        if ($wash->status == "Active") {
            $wash->status = "Inactive";
        } else {
            $wash->status = "Active";
        }

        $wash->updated_by = Auth::user()->id;
        $wash->save();
    }
}
