<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $buyers = "";
            $query = Buyer::select('buyers.*');

            if($request->status){
                $query->where('buyers.status', $request->status);
            }

            $buyers = $query->get();

            return DataTables::of($buyers)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == 'Active'){
                    $status = '
                    <span class="badge bg-success">'.$row->status.'</span>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-warning btn-sm statusBtn"><i class="fe fe-check"></i></button>
                    ';
                }else{
                    $status = '
                    <span class="badge bg-warning">'.$row->status.'</span>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm statusBtn"><i class="fe fe-slash"></i></i></button>
                    ';
                };
                return $status;
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-primary editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBtn"><i class="fe fe-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
        }

        return view('admin.buyer.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_name' => 'required|max:255',
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
            'buyer_name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $buyer = Buyer::findOrFail($id);
            $buyer->update($request->all()+[
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
        if($request->ajax()){
            $trashed_buyers = Buyer::onlyTrashed();
            return DataTables::of($trashed_buyers)
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success restoreBtn"><i class="fe fe-refresh-ccw"></i></button>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-danger forceDeleteBtn"><i class="fe fe-delete"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function restore($id)
    {
        Buyer::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Buyer::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        $buyer = Buyer::onlyTrashed()->where('id', $id)->first();
        $buyer->forceDelete();
    }

    public function status($id)
    {
        $buyer = Buyer::findOrFail($id);
        if($buyer->status == "Active"){
            $buyer->status = "Inactive";
        }else{
            $buyer->status = "Active";
        }
        $buyer->updated_by = Auth::user()->id;
        $buyer->save();
    }
}
