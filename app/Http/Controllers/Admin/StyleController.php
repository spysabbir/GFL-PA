<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StyleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Style::leftJoin('buyers', 'styles.buyer_id', '=', 'buyers.id');

            if ($request->status) {
                $query->where('styles.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $styles = $query->select('styles.*', 'buyers.buyer_name')
                            ->get();

            return DataTables::of($styles)
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

        $buyers = Buyer::all();
        return view('admin.style.index', compact('buyers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Style::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $style = Style::where('id', $id)->first();
        return response()->json($style);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $style = Style::findOrFail($id);
            $style->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $style = Style::findOrFail($id);
        $style->updated_by = Auth::user()->id;
        $style->deleted_by = Auth::user()->id;
        $style->save();
        $style->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_styles = Style::onlyTrashed()
                    ->leftJoin('buyers', 'styles.buyer_id', '=', 'buyers.id');

            $trashed_styles->orderBy('deleted_at', 'desc')
                        ->select('styles.*', 'buyers.buyer_name')
                        ->get();

            return DataTables::of($trashed_styles)
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

        return view('admin.style.index');
    }

    public function restore(string $id)
    {
        Style::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Style::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $style = Style::onlyTrashed()->where('id', $id)->first();
        $style->forceDelete();
    }

    public function status(string $id)
    {
        $style = Style::findOrFail($id);

        if ($style->status == "Active") {
            $style->status = "Inactive";
        } else {
            $style->status = "Active";
        }

        $style->updated_by = Auth::user()->id;
        $style->save();
    }
}
