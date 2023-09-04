<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\MasterStyle;
use App\Models\NewCuttingDetail;
use App\Models\NewCuttingSummary;
use App\Models\StyleBpoOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class NewCuttingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = NewCuttingSummary::select('new_cutting_summaries.*');

            if ($request->document_date) {
                $query->where('new_cutting_summaries.document_date', $request->document_date);
            }

            $query->orderBy('created_at', 'desc');

            $cuttingDoc = $query->get();

            return DataTables::of($cuttingDoc)
                ->addIndexColumn()
                ->editColumn('total_cutting_qty', function ($row) {
                    return '<span class="badge text-white bg-orange">' . NewCuttingDetail::where('summary_id', $row->id)->sum('daily_cutting_qty') . '</span>';
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'Active') {
                        $status = '<span class="badge text-white bg-green">' . $row->status . '</span>';
                    } else {
                        $status = '<span class="badge text-white bg-orange">' . $row->status . '</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['total_cutting_qty', 'status', 'action'])
                ->make(true);
        }

        return view('employee.new-cutting.index');
    }

    public function create(){
        $allStyle = MasterStyle::where('status', 'Running')->get();
        return view('employee.new-cutting.create', compact('allStyle'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_date' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $getData = NewCuttingSummary::create($request->except('document_number')+[
                'document_number' => date('Y').'/'.Auth::user()->id,
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'getData' => $getData,
                'status' => 200,
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'document_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $cuttindDoc = NewCuttingSummary::findOrFail($id);
            $cuttindDoc->update([
                'document_date' => $request->document_date,
                'remarks' => $request->remarks,
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'cuttindDoc' => $cuttindDoc,
                'status' => 200,
            ]);
        }
    }

    public function getSearchStyleInfo(Request $request)
    {
        $send_data = "";

        $query = MasterStyle::where('status', 'Running');

        if ($request->unique_id) {
            $query->where('unique_id', $request->unique_id);
        }
        if ($request->style_id) {
            $query->where('style_id', $request->style_id);
        }

        $all_style = $query->get();

        foreach ($all_style as $style) {
            $buyer_name = $style->buyer->buyer_name;
            $style_name = $style->style->style_name;
            $season_name = $style->season->season_name;
            $color_name = $style->color->color_name;
            $wash_name = $style->wash->wash_name;
            $total_cutting = NewCuttingDetail::where('unique_id', $style->unique_id)->sum('daily_cutting_qty');

            $ids = NewCuttingSummary::where('document_date', '<=', $request->document_date)->pluck('id');
            $total_cutting = NewCuttingDetail::where('unique_id', $style->unique_id)->whereIn('summary_id', $ids)->sum('daily_cutting_qty');

            $send_data .= "
            <tr>
                <td>$style->unique_id</td>
                <td>$buyer_name</td>
                <td>$style_name</td>
                <td>$season_name</td>
                <td>$color_name</td>
                <td>$wash_name</td>
                <td>
                    <input type='text' name='daily_cutting_qty' value=''>
                    <span class='text-danger error-text daily_cutting_qty_error'></span>
                </td>
                <td>$total_cutting</td>
                <td><button type='button' class='btn btn-secondary' id='addCutingStyleBtn'>Add</button></td>
            </tr>
            ";
        }
        return response()->json($send_data);
    }

    public function addNewCuttingStyle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'daily_cutting_qty' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $exists = NewCuttingDetail::where('summary_id', $request->summary_id)->where('unique_id', $request->unique_id)->exists();
            if($exists){
                return response()->json([
                    'status' => 401,
                ]);
            }else{
                $styleInfo = new NewCuttingDetail();
                $styleInfo->summary_id = $request->summary_id;
                $styleInfo->unique_id = $request->unique_id;
                $styleInfo->daily_cutting_qty = $request->daily_cutting_qty;
                $styleInfo->save();

                return response()->json([
                    'status' => 200,
                ]);
            }
        }
    }

    public function getNewCuttingStyle(Request $request)
    {
        if ($request->ajax()) {
            $query = NewCuttingDetail::select('new_cutting_details.*')
                                ->where('new_cutting_details.summary_id', $request->summary_id)
                                ->get();

            $totalCuttingQty = $query->sum('daily_cutting_qty');

            $documentDate = "'>=', $request->document_date";

            $ids = NewCuttingSummary::whereDate('document_date', $documentDate)->pluck('id');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('styleWiseTotalCuttingQty', function ($row) use ($ids) {
                    $styleWiseTotalCuttingQty = NewCuttingDetail::where('unique_id', $row->unique_id)
                        ->whereIn('summary_id', $ids)
                        ->sum('daily_cutting_qty');
                    return '<span class="badge text-white bg-orange">' . $styleWiseTotalCuttingQty . '</span>';
                })
                ->editColumn('styleWiseCuttingPercentage', function ($row) use ($ids) {
                    $styleWiseTotalCuttingQty = NewCuttingDetail::where('unique_id', $row->unique_id)
                        ->whereIn('summary_id', $ids)
                        ->sum('daily_cutting_qty');

                    $master_style_id = MasterStyle::where('unique_id', $row->unique_id)->first()->id;
                    $styleWiseTotalOrder = StyleBpoOrder::where('master_style_id', $master_style_id)->sum('order_quantity');

                    return '<span class="badge text-white bg-orange">' . $styleWiseTotalCuttingQty - $styleWiseTotalOrder . '</span>';
                })

                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->with('totalCuttingQty', $totalCuttingQty)
                ->rawColumns(['styleWiseTotalCuttingQty', 'styleWiseCuttingPercentage', 'action'])
                ->make(true);
        }

        return view('employee.new-cutting.create');
    }

    public function newCuttingStyleDestroy(string $id)
    {
        $cuttingStyle = NewCuttingDetail::findOrFail($id);
        $cuttingStyle->delete();
    }

    public function newCuttingSubmit(string $id)
    {
        $cuttingDocument = NewCuttingSummary::findOrFail($id);
        $cuttingDocument->update([
            'status' => 'Active',
            'updated_by' => Auth::user()->id,
        ]);
    }

    // public function destroy(string $id)
    // {
    //     $buyer = Buyer::findOrFail($id);
    //     $buyer->updated_by = Auth::user()->id;
    //     $buyer->deleted_by = Auth::user()->id;
    //     $buyer->save();
    //     $buyer->delete();
    // }

    // public function trashed(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $trashed_buyers = Buyer::onlyTrashed();

    //         $trashed_buyers->orderBy('deleted_at', 'desc');

    //         return DataTables::of($trashed_buyers)
    //             ->addColumn('action', function ($row) {
    //                 $btn = '
    //                     <button type="button" data-id="'.$row->id.'" class="btn text-white bg-lime restoreBtn"><i class="fe fe-refresh-ccw"></i></button>
    //                     <button type="button" data-id="'.$row->id.'" class="btn text-white bg-red forceDeleteBtn"><i class="fe fe-delete"></i></button>
    //                 ';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('employee.new-cutting.index');
    // }

    // public function restore(string $id)
    // {
    //     Buyer::onlyTrashed()->where('id', $id)->update([
    //         'deleted_by' => NULL
    //     ]);

    //     Buyer::onlyTrashed()->where('id', $id)->restore();
    // }

    // public function forceDelete(string $id)
    // {
    //     $buyer = Buyer::onlyTrashed()->where('id', $id)->first();
    //     $buyer->forceDelete();
    // }

    // public function status(string $id)
    // {
    //     $buyer = Buyer::findOrFail($id);

    //     if ($buyer->status == "Active") {
    //         $buyer->status = "Inactive";
    //     } else {
    //         $buyer->status = "Active";
    //     }

    //     $buyer->updated_by = Auth::user()->id;
    //     $buyer->save();
    // }
}
