<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Imports\BpoOrderImport;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\GarmentType;
use App\Models\MasterStyle;
use App\Models\Season;
use App\Models\Style;
use App\Models\StyleBpoOrder;
use App\Models\Wash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class MasterStyleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:master-style.list|master-style.create|master-style.edit|master-style.delete|master-style.trashed|master-style.forceDelete|bpoOrderList|manageBpoOrder', ['only' => ['index','show']]);
        $this->middleware('permission:master-style.create', ['only' => ['create','store']]);
        $this->middleware('permission:master-style.edit', ['only' => ['edit','update', 'statusEdit', 'statusUpdate']]);
        $this->middleware('permission:master-style.delete', ['only' => ['destroy']]);
        $this->middleware('permission:master-style.trashed', ['only' => ['trashed', 'restore']]);
        $this->middleware('permission:master-style.forceDelete', ['only' => ['forceDelete']]);
        $this->middleware('permission:bpoOrderList|manageBpoOrder', ['only' => ['bpoOrderList']]);
        $this->middleware('permission:manageBpoOrder', ['only' => ['bpoOrderStore', 'bpoOrderUpload', 'bpoOrderEdit', 'bpoOrderUpdate', 'bpoOrderDelete', 'bpoOrderDeleteAll']]);
    }

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
            if ($request->buyer_id) {
                $query->where('master_styles.buyer_id', $request->buyer_id);
            }
            if ($request->style_id) {
                $query->where('master_styles.style_id', $request->style_id);
            }
            if ($request->season_id) {
                $query->where('master_styles.season_id', $request->season_id);
            }
            if ($request->color_id) {
                $query->where('master_styles.color_id', $request->color_id);
            }
            if ($request->wash_id) {
                $query->where('master_styles.wash_id', $request->wash_id);
            }
            if ($request->garment_type_id) {
                $query->where('master_styles.garment_type_id', $request->garment_type_id);
            }


            $query->orderBy('created_at', 'desc');

            $styles = $query->select('master_styles.*', 'buyers.buyer_name', 'styles.style_name', 'seasons.season_name', 'colors.color_name', 'washes.wash_name')
                            ->get();

            return DataTables::of($styles)
                ->addIndexColumn()
                ->addColumn('order_qty', function ($row) {
                    $order_qty = '<span class="badge text-white bg-red">' . StyleBpoOrder::where('master_style_id', $row->id)->sum('order_quantity') . '</span>';
                    return $order_qty;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'Inactive') {
                        $status = '<span class="badge text-white bg-pink">' . $row->status . '</span>';
                    } elseif ($row->status == 'Running') {
                        $status = '<span class="badge text-white bg-green">' . $row->status . '</span>';
                    } elseif ($row->status == 'Hold') {
                        $status = '<span class="badge text-white bg-yellow">' . $row->status . '</span>';
                    } elseif ($row->status == 'Close') {
                        $status = '<span class="badge text-white bg-orange">' . $row->status . '</span>';
                    } else {
                        $status = '<span class="badge text-white bg-red">' . $row->status . '</span>';
                    }
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-teal btn-sm statusEditBtn ml-1" data-toggle="modal" data-target="#statusEditModal"><i class="fe fe-edit"></i></button>';
                    $status_btn = $status . $btn;
                    return $status_btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('employee.master-style.edit', $row->id).'" class="btn text-white bg-purple btn-sm"><i class="fe fe-edit"></i></a>
                        <a href="'.route('employee.master-style.show', $row->id).'" class="btn text-white bg-azure btn-sm"><i class="fe fe-eye"></i></a>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['order_qty', 'status', 'action'])
                ->make(true);
        }

        $buyers = Buyer::where('status', 'Active')->get();
        $styles = Style::where('status', 'Active')->get();
        $seasons = Season::where('status', 'Active')->get();
        $colors = Color::where('status', 'Active')->get();
        $washs = Wash::where('status', 'Active')->get();
        $garmentTypes = GarmentType::where('status', 'Active')->get();

        return view('employee.master-style.index', compact('buyers', 'styles', 'seasons', 'colors', 'washs', 'garmentTypes'));
    }

    public function getStyleInfo(Request $request)
    {
        $send_data = "<option value=''>--Select Style--</option>";
        $all_style = Style::where('buyer_id', $request->buyer_id)->get();
        foreach ($all_style as $style) {
            $send_data .= "<option value='$style->id'>$style->style_name</option>";
        }
        return response()->json($send_data);
    }

    public function create()
    {
        $buyers = Buyer::where('status', 'Active')->get();
        $styles = Style::where('status', 'Active')->get();
        $seasons = Season::where('status', 'Active')->get();
        $colors = Color::where('status', 'Active')->get();
        $washs = Wash::where('status', 'Active')->get();
        $garmentTypes = GarmentType::where('status', 'Active')->get();

        return view('employee.master-style.create', compact('buyers', 'styles', 'seasons', 'colors', 'washs', 'garmentTypes'));
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
            $exists = MasterStyle::where('buyer_id', $request->buyer_id)
                                ->where('style_id', $request->style_id)
                                ->where('season_id', $request->season_id)
                                ->where('color_id', $request->color_id)
                                ->where('wash_id', $request->wash_id)
                                ->exists();
            if ($exists) {
                return response()->json([
                    'status' => 401,
                ]);
            } else {
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
    }

    public function show(string $id)
    {
        $masterStyle = MasterStyle::findOrFail($id);
        $styleWiseBpoOrder = StyleBpoOrder::where('master_style_id', $id)->get();

        return view('employee.master-style.view', compact('masterStyle', 'styleWiseBpoOrder'));
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

        return view('employee.master-style.edit', compact('masterStyle', 'buyers', 'styles', 'seasons', 'colors', 'washs', 'garmentTypes'));
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
            $existsId = MasterStyle::where('id', $id)
                                ->where('buyer_id', $request->buyer_id)
                                ->where('style_id', $request->style_id)
                                ->where('season_id', $request->season_id)
                                ->where('color_id', $request->color_id)
                                ->where('wash_id', $request->wash_id)
                                ->exists();
            $exists = MasterStyle::where('buyer_id', $request->buyer_id)
                                ->where('style_id', $request->style_id)
                                ->where('season_id', $request->season_id)
                                ->where('color_id', $request->color_id)
                                ->where('wash_id', $request->wash_id)
                                ->exists();
            if (!$existsId && $exists) {
                return response()->json([
                    'status' => 401,
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

        return view('employee.master-style.index');
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
        StyleBpoOrder::where('master_style_id', $id)->delete();
        $masterStyle = MasterStyle::onlyTrashed()->where('id', $id)->first();
        $masterStyle->forceDelete();
    }

    public function statusEdit(string $id)
    {
        $masterStyle = MasterStyle::findOrFail($id);
        return response()->json($masterStyle);
    }

    public function statusUpdate(Request $request, string $id)
    {
        $checkBpoOrder = StyleBpoOrder::where('master_style_id', $id)->exists();
        if($request->status == 'Running' && !$checkBpoOrder){
            return response()->json([
                'status' => 401,
            ]);
        }else{
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
    }

    public function getMasterStyleDetails($id)
    {
        $sumOrder = StyleBpoOrder::where('master_style_id', $id)->sum('order_quantity');
        $status = MasterStyle::findOrFail($id)->status;

        return response()->json([
            'sumOrder' => $sumOrder,
            'status' => $status,
        ]);
    }

    // Bpo Order Method

    public function bpoOrderList(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = StyleBpoOrder::where('master_style_id', $id);

            $query->orderBy('created_at', 'desc');

            $styleBpoOrderList = $query->select('style_bpo_orders.*')->get();

            return DataTables::of($styleBpoOrderList)
                ->addIndexColumn()
                ->editColumn('checkbox', function($row){
                    return'
                    <input type="checkbox" class="bpoOrderChecked" value="'.$row->id.'">
                    ';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                        <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('employee.master-style.edit');
    }

    public function bpoOrderStore(Request $request)
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
            StyleBpoOrder::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            MasterStyle::findOrFail($request->master_style_id)->update([
                'status' => 'Running',
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function bpoOrderUpload(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'bpo_order_file' => 'required|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray(),
            ]);
        } else {
            $masterStyleId = $id;
            $fileName = $request->file('bpo_order_file');

            try {
                Excel::import(new BpoOrderImport($masterStyleId), $fileName);

                MasterStyle::findOrFail($masterStyleId)->update([
                    'status' => 'Running',
                ]);

                return response()->json([
                    'status' => 200,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500 ,
                    'field_error' => $e->getMessage(),
                ]);
            }
        }
    }

    public function bpoOrderEdit(string $id)
    {
        $styleBpoOrder = StyleBpoOrder::findOrFail($id);
        return response()->json($styleBpoOrder);
    }

    public function bpoOrderUpdate(Request $request, string $id)
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
            $styleBpoOrder = StyleBpoOrder::findOrFail($id);
            $styleBpoOrder->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function bpoOrderDelete(string $id)
    {
        $masterStyleId = StyleBpoOrder::findOrFail($id)->master_style_id;

        if (StyleBpoOrder::where('master_style_id', $masterStyleId)->count() == 1) {
            MasterStyle::findOrFail($masterStyleId)->update([
                'status' => 'Inactive',
            ]);
        }

        StyleBpoOrder::findOrFail($id)->delete();
    }

    public function bpoOrderDeleteAll(Request $request)
    {
        if ($request->all_selected_id) {
            $all_selected_id = explode( ',', $request->all_selected_id );
            foreach($all_selected_id as $selected_id){
                $masterStyleId = StyleBpoOrder::findOrFail($selected_id)->master_style_id;
                MasterStyle::findOrFail($masterStyleId)->update([
                    'status' => 'Inactive',
                ]);

                StyleBpoOrder::findOrFail($selected_id)->delete();
            }
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }

}
