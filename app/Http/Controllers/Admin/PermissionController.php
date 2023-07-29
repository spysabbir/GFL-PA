<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Permission::select('permissions.*');

            $query->orderBy('created_at', 'desc');

            $permissions = $query->get();

            return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.permission.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Permission::create($request->all());

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $permission = Permission::where('id', $id)->first();
        return response()->json($permission);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $permission = Permission::findOrFail($id);
            $permission->update($request->all());

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    }


}
