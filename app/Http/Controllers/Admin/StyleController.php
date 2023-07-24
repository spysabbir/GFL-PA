<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\Season;
use App\Models\Style;
use App\Models\Wash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StyleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Style::leftJoin('buyers', 'styles.buyer_id', '=', 'buyers.id')
                        ->leftJoin('seasons', 'styles.season_id', '=', 'seasons.id')
                        ->leftJoin('colors', 'styles.color_id', '=', 'colors.id')
                        ->leftJoin('washes', 'styles.wash_id', '=', 'washes.id');

            if ($request->status) {
                $query->where('styles.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $styles = $query->select('styles.*', 'buyers.buyer_name', 'seasons.season_name', 'colors.color_name', 'washes.wash_name')
                            ->get();

            return DataTables::of($styles)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'Hole') {
                        $status = '<span class="badge text-white bg-warning">' . $row->status . '</span>';
                    }elseif ($row->status == 'Running') {
                        $status = '<span class="badge text-white bg-green">' . $row->status . '</span>';
                    }elseif ($row->status == 'Close') {
                        $status = '<span class="badge text-white bg-info">' . $row->status . '</span>';
                    }else{
                        $status = '<span class="badge text-white bg-danger">' . $row->status . '</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.style.edit', $row->id).'" class="btn text-white bg-purple btn-sm"><i class="fe fe-edit"></i></a>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.style.index');
    }

    public function create()
    {
        $buyers = Buyer::where('status', 'Active')->get();
        $seasons = Season::where('status', 'Active')->get();
        $colors = Color::where('status', 'Active')->get();
        $washs = Wash::where('status', 'Active')->get();
        return view('admin.style.create', compact('buyers', 'seasons', 'colors', 'washs'));
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
        $style = Style::findOrFail($id);

        $buyers = Buyer::where('status', 'Active')->get();
        $seasons = Season::where('status', 'Active')->get();
        $colors = Color::where('status', 'Active')->get();
        $washs = Wash::where('status', 'Active')->get();

        return view('admin.style.edit', compact('style', 'buyers', 'seasons', 'colors', 'washs'));
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
            $query = Style::onlyTrashed()
                        ->leftJoin('buyers', 'styles.buyer_id', '=', 'buyers.id')
                        ->leftJoin('seasons', 'styles.season_id', '=', 'seasons.id')
                        ->leftJoin('colors', 'styles.color_id', '=', 'colors.id')
                        ->leftJoin('washes', 'styles.wash_id', '=', 'washes.id');

            $trashed_styles = $query->orderBy('deleted_at', 'desc')
                        ->select('styles.*', 'buyers.buyer_name', 'seasons.season_name', 'colors.color_name', 'washes.wash_name')
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
}
