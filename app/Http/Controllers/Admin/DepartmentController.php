<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Department::select('departments.*');

            $query->orderBy('created_at', 'desc');

            $departments = $query->get();

            return DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.department.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255|unique:departments,department_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Department::create($request->all() + [
                'created_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $department = Department::where('id', $id)->first();
        return response()->json($department);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255|unique:departments,department_name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $department = Department::findOrFail($id);
            $department->update($request->all() + [
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
    }
}
