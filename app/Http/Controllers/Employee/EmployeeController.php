<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function dashboard ()
    {
        return view('employee.dashboard');
    }

    public function profile (Request $request)
    {
        return view('employee.profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function index (Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id');

            if ($request->status) {
                $query->where('employees.status', $request->status);
            }
            if ($request->department_id) {
                $query->where('employees.department_id', $request->department_id);
            }
            if ($request->designation_id) {
                $query->where('employees.designation_id', $request->designation_id);
            }
            if ($request->gender) {
                $query->where('employees.gender', $request->gender);
            }

            $query->orderBy('created_at', 'desc');

            $employees = $query->select('employees.*', 'departments.department_name', 'designations.designation_name')
                                ->get();

            return DataTables::of($employees)
                ->addIndexColumn()
                ->editColumn('profile_photo', function ($row) {
                    return '<img class="avatar avatar-xl" src="'.asset('uploads/profile_photo').'/' .$row->profile_photo.'" alt="">';
                })
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
                    $btn = '<a href="'.route('employee.employee.edit', $row->id).'" class="btn text-white bg-purple btn-sm"><i class="fe fe-edit"></i></a>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['profile_photo', 'status', 'action'])
                ->make(true);
        }

        $departments = Department::where('status', 'Active')->get();
        $designations = Designation::where('status', 'Active')->get();
        return view('employee.employee.index', compact('departments', 'designations'));
    }

    public function create ()
    {
        $departments = Department::where('status', 'Active')->get();
        $designations = Designation::where('status', 'Active')->get();
        return view('employee.employee.create', compact('departments', 'designations'));
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
            'email' => ['nullable', 'string', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'unique:'.Employee::class],
            'profile_photo' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $exists = Employee::where('nid_no', $request->nid_no)->exists();
            if ($exists) {
                return response()->json([
                    'status' => 401,
                ]);
            } else {
                // Profile Photo Upload
                if($request->hasFile('profile_photo')){
                    $profile_photo_name = "profile_photo".".". $request->file('profile_photo')->getClientOriginalExtension();
                    $upload_link = base_path("public/uploads/profile_photo/").$profile_photo_name;
                    Image::make($request->file('profile_photo'))->resize(120, 120)->save($upload_link);
                }else{
                    $profile_photo_name = "default_profile_photo.png";
                }

                Employee::create($request->except('profile_photo')+[
                    'profile_photo' => $profile_photo_name,
                    'created_by' => Auth::user()->id,
                ]);

                return response()->json([
                    'status' => 200,
                ]);
            }
        }
    }

    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);

        $departments = Department::where('status', 'Active')->get();
        $designations = Designation::where('status', 'Active')->get();

        return view('employee.employee.edit', compact('employee', 'departments', 'designations'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
            'email' => 'nullable|string|max:255|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:users,email,' . $id,
            'profile_photo' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $existsId = Employee::where('id', $id)->where('nid_no', $request->nid_no)->exists();
            $exists = Employee::where('nid_no', $request->nid_no)->exists();
            if (!$existsId && $exists) {
                return response()->json([
                    'status' => 401,
                ]);
            } else {
                $employee  = Employee::findOrFail($id);

                // Profile Photo Upload
                if($request->hasFile('profile_photo')){
                    if($employee->profile_photo != 'default_profile_photo.png'){
                        unlink(base_path("public/uploads/profile_photo/").$employee->profile_photo);
                    }
                    $profile_photo_name = "profile_photo".".". $request->file('profile_photo')->getClientOriginalExtension();
                    $upload_link = base_path("public/uploads/profile_photo/").$profile_photo_name;
                    Image::make($request->file('profile_photo'))->resize(120, 120)->save($upload_link);
                    $employee->update([
                        'profile_photo' => $profile_photo_name,
                        'updated_by' => Auth::user()->id,
                    ]);
                };

                $employee->update($request->except('profile_photo')+[
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
        $employee = Employee::findOrFail($id);
        $employee->updated_by = Auth::user()->id;
        $employee->deleted_by = Auth::user()->id;
        $employee->save();
        $employee->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::onlyTrashed();

            $trashed_employees = $query->orderBy('deleted_at', 'desc')->get();

            return DataTables::of($trashed_employees)
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

        return view('employee.employee.index');
    }

    public function restore(string $id)
    {
        Employee::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        Employee::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $employee = Employee::onlyTrashed()->where('id', $id)->first();
        if($employee->profile_photo != 'default_profile_photo.png'){
            unlink(base_path("public/uploads/profile_photo/").$employee->profile_photo);
        }
        $employee->forceDelete();
    }

    public function status(string $id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->status == "Active") {
            $employee->status = "Inactive";
        } else {
            $employee->status = "Active";
        }

        $employee->updated_by = Auth::user()->id;
        $employee->save();
    }
}
