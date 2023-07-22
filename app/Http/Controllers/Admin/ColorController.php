<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Color::select('colors.*');

            if ($request->status) {
                $query->where('colors.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $colors = $query->get();

            return DataTables::of($colors)
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

        return view('admin.color.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'color_name' => 'required|string|max:255|unique:colors,color_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Color::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $color = Color::where('id', $id)->first();
        return response()->json($color);
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'color_name' => 'required|string|max:255|unique:colors,color_name,' . $id,

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $color = Color::findOrFail($id);
            $color->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $color = Color::findOrFail($id);
        $color->updated_by = Auth::user()->id;
        $color->deleted_by = Auth::user()->id;
        $color->save();
        $color->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_colors = Color::onlyTrashed();

            $trashed_colors->orderBy('deleted_at', 'desc');

            return DataTables::of($trashed_colors)
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

        return view('admin.color.index');
    }

    public function restore(string $id)
    {
        Color::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Color::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $color = Color::onlyTrashed()->where('id', $id)->first();
        $color->forceDelete();
    }

    public function status(string $id)
    {
        $color = Color::findOrFail($id);

        if ($color->status == "Active") {
            $color->status = "Inactive";
        } else {
            $color->status = "Active";
        }

        $color->updated_by = Auth::user()->id;
        $color->save();
    }
}
