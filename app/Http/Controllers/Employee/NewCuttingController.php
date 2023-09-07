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
                    if ($row->status == 'Running') {
                        $status = '<span class="badge text-white bg-pink">' . $row->status . '</span>';
                    } elseif ($row->status == 'Updating') {
                        $status = '<span class="badge text-white bg-red">' . $row->status . '</span>';
                    } else {
                        $status = '<span class="badge text-white bg-green">' . $row->status . '</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('employee.new-cutting.edit', $row->id) . '" class="btn text-white bg-purple btn-sm"><i class="fe fe-edit"></i></a>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn" ' . ($row->status != "Running" ? "disabled" : "") . '><i class="fe fe-trash"></i></button>';
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

    public function edit(string $id){
        $cuttingDocument = NewCuttingSummary::findOrFail($id);

        $allStyle = MasterStyle::where('status', 'Running')->get();
        return view('employee.new-cutting.edit', compact('cuttingDocument', 'allStyle'));
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
            $maxChalan = NewCuttingSummary::whereYear('document_date', date('Y'))->latest('document_number')->value('document_number');
            $autoValue = ($maxChalan ? (int) explode('/', $maxChalan)[1] : 0) + 1;

            $getData = NewCuttingSummary::create($request->all()+[
                'document_number' => date('Y').'/'.$autoValue,
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

        if($all_style->count() > 0){
            foreach ($all_style as $style) {
                $buyer_name = $style->buyer->buyer_name;
                $style_name = $style->style->style_name;
                $season_name = $style->season->season_name;
                $color_name = $style->color->color_name;
                $wash_name = $style->wash->wash_name;
                $total_cutting = NewCuttingDetail::where('unique_id', $style->unique_id)->sum('daily_cutting_qty');

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
        }else{
            $send_data .= "
            <tr>
                <td colspan='50' class='text-danger text-center'>Please Select Right Style or System Id</td>
            </tr>
            ";
        }

        return response()->json($send_data);
    }

    public function addNewCuttingStyle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'daily_cutting_qty' => 'required|gt:0',
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
                $styleInfo->created_by = Auth::user()->id;
                $styleInfo->save();

                return response()->json([
                    'status' => 200,
                ]);
            }
        }
    }

    public function updateNewCuttingStyle(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'daily_cutting_qty' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            if($request->daily_cutting_qty < 1){
                return response()->json([
                    'status' => 401,
                ]);
            }else{
                $styleInfo = NewCuttingDetail::findOrFail($id);
                $styleInfo->update([
                    'daily_cutting_qty' => $request->daily_cutting_qty,
                    'updated_by' => Auth::user()->id,
                ]);

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

            if($request->summary_id){
                $status = NewCuttingSummary::where('id', $request->summary_id)->first()->status;
            }else{
                $status = "Running";
            }

            $start_date = NewCuttingSummary::orderBy('document_date', 'asc')->first()->document_date;
            $end_date = $request->document_date;
            $ids = NewCuttingSummary::whereBetween('document_date', [$start_date, $end_date])->pluck('id');

            $data = DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" value="' . $row->id . '" class="cuttingStyleChecked">';
                })
                ->editColumn('daily_cutting_qty', function ($row) use ($status) {
                    return '<input type="number" data-id="' . $row->id . '" class="updateNewCuttingQty" ' . ($status != "Running" ? "disabled" : "") . ' value="'.$row->daily_cutting_qty.'">';
                })
                ->editColumn('styleWiseTotalCuttingQty', function ($row) use ($ids) {
                    $styleWiseTotalCuttingQty = NewCuttingDetail::where('unique_id', $row->unique_id)
                        ->whereIn('summary_id', $ids)
                        ->sum('daily_cutting_qty');
                    return '<span class="badge text-white bg-orange">' . $styleWiseTotalCuttingQty . '</span>';
                })
                ->editColumn('styleWiseTotalOrder', function ($row) {
                    $master_style_id = MasterStyle::where('unique_id', $row->unique_id)->first()->id;
                    $styleWiseTotalOrder = StyleBpoOrder::where('master_style_id', $master_style_id)->sum('order_quantity');
                    return '<span class="badge text-white bg-orange">' . $styleWiseTotalOrder . '</span>';
                })
                ->editColumn('styleWiseCuttingPercentage', function ($row) use ($ids) {
                    $styleWiseTotalCuttingQty = NewCuttingDetail::where('unique_id', $row->unique_id)
                        ->whereIn('summary_id', $ids)
                        ->sum('daily_cutting_qty');

                    $master_style_id = MasterStyle::where('unique_id', $row->unique_id)->first()->id;
                    $styleWiseTotalOrder = StyleBpoOrder::where('master_style_id', $master_style_id)->sum('order_quantity');

                    $styleWiseCuttingPercentage = ((($styleWiseTotalCuttingQty - $styleWiseTotalOrder) / $styleWiseTotalOrder) * 100);

                    return '<span class="badge text-white bg-orange">' . number_format($styleWiseCuttingPercentage, 2) . ' %'. '</span>';
                })
                ->addColumn('action', function ($row) use ($status) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn" ' . ($status != "Running" ? "disabled" : "") . '><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['checkbox', 'daily_cutting_qty', 'styleWiseTotalOrder', 'styleWiseTotalCuttingQty', 'styleWiseCuttingPercentage', 'action'])
                ->toArray();

            $data['totalCuttingQty'] = $totalCuttingQty;

            return response()->json($data);
        }
    }

    public function newCuttingStyleDestroy(string $id)
    {
        $cuttingStyle = NewCuttingDetail::findOrFail($id);
        $cuttingStyle->forceDelete();
    }

    public function newCuttingSubmit(string $id)
    {
        $cuttingDocument = NewCuttingSummary::findOrFail($id);
        $cuttingDocument->update([
            'status' => 'Submitted',
            'updated_by' => Auth::user()->id,
        ]);
    }

    public function newCuttingStyleDestroyAll(Request $request)
    {
        if ($request->all_selected_id) {
            $all_selected_id = explode( ',', $request->all_selected_id );
            foreach($all_selected_id as $selected_id){
                NewCuttingDetail::findOrFail($selected_id)->forceDelete();
            }
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $cuttingDocument = NewCuttingSummary::findOrFail($id);
        $cuttingDocument->updated_by = Auth::user()->id;
        $cuttingDocument->deleted_by = Auth::user()->id;
        $cuttingDocument->save();
        $cuttingDocument->delete();

        $cuttingStyles = NewCuttingDetail::where('summary_id', $id)->get();
        foreach ($cuttingStyles as $cuttingStyle) {
            $cuttingStyle->updated_by = Auth::user()->id;
            $cuttingStyle->deleted_by = Auth::user()->id;
            $cuttingStyle->save();
            $cuttingStyle->delete();
        }
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_cuttingDocuments = NewCuttingSummary::onlyTrashed();

            $trashed_cuttingDocuments->orderBy('deleted_at', 'desc');

            return DataTables::of($trashed_cuttingDocuments)
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

        return view('employee.new-cutting.index');
    }

    public function restore(string $id)
    {
        NewCuttingSummary::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        NewCuttingSummary::onlyTrashed()->where('id', $id)->restore();

        NewCuttingDetail::onlyTrashed()->where('summary_id', $id)->update([
            'deleted_by' => NULL
        ]);
        NewCuttingDetail::onlyTrashed()->where('summary_id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        NewCuttingDetail::where('summary_id', $id)->forceDelete();

        $cuttingDocument = NewCuttingSummary::onlyTrashed()->where('id', $id)->first();
        $cuttingDocument->forceDelete();
    }

    public function status(string $id)
    {
        $cuttingDocument = NewCuttingSummary::findOrFail($id);
        $cuttingDocument->status = "Updating";
        $cuttingDocument->updated_by = Auth::user()->id;
        $cuttingDocument->save();
    }
}
