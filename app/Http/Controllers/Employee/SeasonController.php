<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SeasonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Season::select('seasons.*');

            if ($request->status) {
                $query->where('seasons.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $seasons = $query->get();

            return DataTables::of($seasons)
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

        return view('employee.season.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'season_name' => 'required|string|max:255|unique:seasons,season_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Season::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $season = Season::where('id', $id)->first();
        return response()->json($season);
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'season_name' => 'required|string|max:255|unique:seasons,season_name,' . $id,

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $season = Season::findOrFail($id);
            $season->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $season = Season::findOrFail($id);
        $season->updated_by = Auth::user()->id;
        $season->deleted_by = Auth::user()->id;
        $season->save();
        $season->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_seasons = Season::onlyTrashed();

            $trashed_seasons->orderBy('deleted_at', 'desc')->get();

            return DataTables::of($trashed_seasons)
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

        return view('employee.season.index');
    }

    public function restore(string $id)
    {
        Season::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Season::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $season = Season::onlyTrashed()->where('id', $id)->first();
        $season->forceDelete();
    }

    public function status(string $id)
    {
        $season = Season::findOrFail($id);

        if ($season->status == "Active") {
            $season->status = "Inactive";
        } else {
            $season->status = "Active";
        }

        $season->updated_by = Auth::user()->id;
        $season->save();
    }
}
