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
            $query = Employee::select('employees.*');

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

            $employees = $query->get();

            return DataTables::of($employees)
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
            'profile_photo' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
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
// if($request->hasFile('category_photo')){
//                 unlink(base_path("public/uploads/category_photo/").$category->category_photo);
//                 $category_photo_name =  $category_slug."-category-photo".".". $request->file('category_photo')->getClientOriginalExtension();
//                 $upload_link = base_path("public/uploads/category_photo/").$category_photo_name;
//                 Image::make($request->file('category_photo'))->resize(272, 140)->save($upload_link);
//                 $category->update([
//                     'category_photo' => $category_photo_name,
//                     'updated_by' => Auth::guard('admin')->user()->id,
//                 ]);
//             }
