<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\BpoOrderImport;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\GarmentType;
use App\Models\MasterStyle;
use App\Models\Season;
use App\Models\Style;
use App\Models\Wash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class MasterStyleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MasterStyle::leftJoin('buyers', 'master_styles.buyer_id', '=', 'buyers.id')
                        ->leftJoin('styles', 'master_styles.style_id', '=', 'styles.id')
                        ->leftJoin('seasons', 'master_styles.season_id', '=', 'seasons.id')
                        ->leftJoin('colors', 'master_styles.color_id', '=', 'colors.id')
                        ->leftJoin('washes', 'master_styles.wash_id', '=', 'washes.id');

            if ($request->status) {
                $query->where('master_styles.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $styles = $query->select('master_styles.*', 'buyers.buyer_name', 'styles.style_name', 'seasons.season_name', 'colors.color_name', 'washes.wash_name')
                            ->get();

            return DataTables::of($styles)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'Hold') {
                        $status = '<span class="badge text-white bg-pink">' . $row->status . '</span>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-green btn-sm statusBtn"><i class="fe fe-check"></i></button>';
                    } elseif ($row->status == 'Running') {
                        $status = '<span class="badge text-white bg-green">' . $row->status . '</span>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-green btn-sm statusBtn"><i class="fe fe-check"></i></button>';
                    } elseif ($row->status == 'Close') {
                        $status = '<span class="badge text-white bg-orange">' . $row->status . '</span>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-green btn-sm statusBtn"><i class="fe fe-check"></i></button>';
                    } else {
                        $status = '<span class="badge text-white bg-red">' . $row->status . '</span>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-orange btn-sm statusBtn"><i class="fe fe-slash"></i></button>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.master-style.edit', $row->id).'" class="btn text-white bg-purple btn-sm"><i class="fe fe-edit"></i></a>
                        <a href="'.route('admin.master-style.show', $row->id).'" class="btn text-white bg-azure btn-sm"><i class="fe fe-eye"></i></a>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.master-style.index');
    }

    public function create()
    {
        $buyers = Buyer::where('status', 'Active')->get();
        $styles = Style::where('status', 'Active')->get();
        $seasons = Season::where('status', 'Active')->get();
        $colors = Color::where('status', 'Active')->get();
        $washs = Wash::where('status', 'Active')->get();
        $garmentTypes = GarmentType::where('status', 'Active')->get();

        return view('admin.master-style.create', compact('buyers', 'styles', 'seasons', 'colors', 'washs', 'garmentTypes'));
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
            $unique_id = MasterStyle::latest('unique_id')->value('unique_id')+1;
            MasterStyle::create($request->all()+[
                'unique_id' => $unique_id,
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function show(string $id)
    {
        $masterStyle = MasterStyle::findOrFail($id);

        return view('admin.master-style.view', compact('masterStyle'));
    }

    public function edit(string $id)
    {
        $masterStyle = MasterStyle::findOrFail($id);

        $buyers = Buyer::where('status', 'Active')->get();
        $styles = Style::where('status', 'Active')->get();
        $seasons = Season::where('status', 'Active')->get();
        $colors = Color::where('status', 'Active')->get();
        $washs = Wash::where('status', 'Active')->get();
        $garmentTypes = GarmentType::where('status', 'Active')->get();

        return view('admin.master-style.edit', compact('masterStyle', 'buyers', 'styles', 'seasons', 'colors', 'washs', 'garmentTypes'));
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
            $masterStyle = MasterStyle::findOrFail($id);

            $masterStyle->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $masterStyle = MasterStyle::findOrFail($id);
        $masterStyle->updated_by = Auth::user()->id;
        $masterStyle->deleted_by = Auth::user()->id;
        $masterStyle->save();
        $masterStyle->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $query = MasterStyle::onlyTrashed()
                        ->leftJoin('buyers', 'master_styles.buyer_id', '=', 'buyers.id')
                        ->leftJoin('styles', 'master_styles.style_id', '=', 'styles.id')
                        ->leftJoin('seasons', 'master_styles.season_id', '=', 'seasons.id')
                        ->leftJoin('colors', 'master_styles.color_id', '=', 'colors.id')
                        ->leftJoin('washes', 'master_styles.wash_id', '=', 'washes.id');

            $trashed_masterStyle = $query->orderBy('deleted_at', 'desc')
                        ->select('master_styles.*', 'buyers.buyer_name', 'styles.style_name', 'seasons.season_name', 'colors.color_name', 'washes.wash_name')
                        ->get();

            return DataTables::of($trashed_masterStyle)
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

        return view('admin.master-style.index');
    }

    public function restore(string $id)
    {
        MasterStyle::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        MasterStyle::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $masterStyle = MasterStyle::onlyTrashed()->where('id', $id)->first();
        $masterStyle->forceDelete();
    }

    public function status(string $id)
    {
        $masterStyle = MasterStyle::findOrFail($id);

        if ($masterStyle->status == "Running") {
            $masterStyle->status = "Cancel";
        } else {
            $masterStyle->status = "Running";
        }

        $masterStyle->updated_by = Auth::user()->id;
        $masterStyle->save();
    }

    public function bpoOrderUpload(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'bpo_order_file' => 'required|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $masterStyleId = $id;
            $fileName = $request->file('bpo_order_file');
            
            Excel::import(new BpoOrderImport($masterStyleId), $fileName);

            return response()->json([
                'status' => 200,
            ]);
        }
    }
}
