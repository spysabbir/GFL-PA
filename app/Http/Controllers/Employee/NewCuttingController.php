<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\MasterStyle;
use App\Models\NewCuttingDetail;
use App\Models\NewCuttingSummary;
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

            if ($request->status) {
                $query->where('buyers.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $buyers = $query->get();

            return DataTables::of($buyers)
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

        return view('employee.new-cutting.index');
    }

    public function create(){
        $allStyle = MasterStyle::where('status', 'Running')->get();

        $totalCuttingQty = '';
        return view('employee.new-cutting.create', compact('allStyle', 'totalCuttingQty'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cutting_date' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $getId = NewCuttingSummary::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'getId' => $getId,
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

            $send_data .= "
            <tr>
                <td>$style->unique_id</td>
                <td>$buyer_name</td>
                <td>$style_name</td>
                <td>$season_name</td>
                <td>$color_name</td>
                <td>$wash_name</td>
                <td>
                    <input type='text' name='cutting_qty' value=''>
                    <span class='text-danger error-text cutting_qty_error'></span>
                </td>
                <td><button type='button' class='btn btn-secondary' id='addCutingStyleBtn'>Add</button></td>
            </tr>
            ";
        }
        return response()->json($send_data);
    }

    public function addNewCuttingStyle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cutting_qty' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $styleInfo = new NewCuttingDetail();
            $styleInfo->cutting_summary_id = $request->cutting_doc_no;
            $styleInfo->unique_id = $request->unique_id;
            $styleInfo->cutting_qty = $request->cutting_qty;
            $styleInfo->save();

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function getNewCuttingStyle(Request $request)
    {
        if ($request->ajax()) {
            $query = NewCuttingDetail::select('new_cutting_details.*');

            $query->where('new_cutting_details.cutting_summary_id', $request->cutting_summary_id);

            $style = $query->get();

            $totalCuttingQty = $style->sum('cutting_qty');

            return DataTables::of($style)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->with('totalCuttingQty', $totalCuttingQty)
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee.new-cutting.create');
    }

    // public function edit(string $id)
    // {
    //     $buyer = Buyer::where('id', $id)->first();
    //     return response()->json($buyer);
    // }

    // public function update(Request $request, string $id)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'buyer_name' => 'required|string|max:255|unique:buyers,buyer_name,' . $id,
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'error' => $validator->errors()->toArray()
    //         ]);
    //     } else {
    //         $buyer = Buyer::findOrFail($id);
    //         $buyer->update($request->all() + [
    //             'updated_by' => Auth::user()->id,
    //         ]);

    //         return response()->json([
    //             'status' => 200,
    //         ]);
    //     }
    // }

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
