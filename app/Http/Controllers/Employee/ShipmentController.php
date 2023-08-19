<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Buyer::select('buyers.*');

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

        return view('employee.shipment.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_name' => 'required|string|max:255|unique:buyers,buyer_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Buyer::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $buyer = Buyer::where('id', $id)->first();
        return response()->json($buyer);
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'buyer_name' => 'required|string|max:255|unique:buyers,buyer_name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $buyer = Buyer::findOrFail($id);
            $buyer->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $buyer = Buyer::findOrFail($id);
        $buyer->updated_by = Auth::user()->id;
        $buyer->deleted_by = Auth::user()->id;
        $buyer->save();
        $buyer->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashed_buyers = Buyer::onlyTrashed();

            $trashed_buyers->orderBy('deleted_at', 'desc');

            return DataTables::of($trashed_buyers)
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

        return view('employee.shipment.index');
    }

    public function restore(string $id)
    {
        Buyer::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Buyer::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $buyer = Buyer::onlyTrashed()->where('id', $id)->first();
        $buyer->forceDelete();
    }

    public function status(string $id)
    {
        $buyer = Buyer::findOrFail($id);

        if ($buyer->status == "Active") {
            $buyer->status = "Inactive";
        } else {
            $buyer->status = "Active";
        }

        $buyer->updated_by = Auth::user()->id;
        $buyer->save();
    }
}
