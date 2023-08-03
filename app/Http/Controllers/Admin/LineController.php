<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LineController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Line::select('lines.*');

            if ($request->status) {
                $query->where('lines.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $lines = $query->get();

            return DataTables::of($lines)
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

        return view('admin.line.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'line_no' => 'required|string|max:255|unique:lines,line_no',
            'department' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Line::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $line = Line::where('id', $id)->first();
        return response()->json($line);
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'line_no' => 'required|string|max:255|unique:lines,line_no,' . $id,
            'department' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $line = Line::findOrFail($id);
            $line->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $line = Line::findOrFail($id);
        $line->updated_by = Auth::user()->id;
        $line->deleted_by = Auth::user()->id;
        $line->save();
        $line->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_lines = Line::onlyTrashed();

            $trashed_lines->orderBy('deleted_at', 'desc');

            return DataTables::of($trashed_lines)
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

        return view('admin.line.index');
    }

    public function restore(string $id)
    {
        Line::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Line::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $line = Line::onlyTrashed()->where('id', $id)->first();
        $line->forceDelete();
    }

    public function status(string $id)
    {
        $line = Line::findOrFail($id);

        if ($line->status == "Active") {
            $line->status = "Inactive";
        } else {
            $line->status = "Active";
        }

        $line->updated_by = Auth::user()->id;
        $line->save();
    }
}
