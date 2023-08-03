<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select('users.*');

            if ($request->status) {
                $query->where('users.status', $request->status);
            }

            $query->orderBy('created_at', 'desc');

            $users = $query->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    $roles = $row->roles;
                    $badgeTags = '';
                    foreach ($roles as $role) {
                        $badgeTags .= '<span class="badge bg-info mr-1">' . $role->name . '</span>';
                    }
                    return $badgeTags;
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
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['roles', 'status', 'action'])
                ->make(true);
        }

        $allRole = Role::all();

        return view('admin.user.index', compact('allRole'));
    }

    public function create()
    {
        $allRole = Role::all();
        return view('admin.user.create', compact('allRole'));
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:30', 'min:5', 'regex:/^[A-Za-z0-9_]+$/', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'unique:'.User::class],
            'roles' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $user = User::create([
                'employee_id' => $request->employee_id,
                'name' => $request->name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make('12345678'),
                'created_by' => Auth::user()->id,
            ]);

            $user->assignRole($request->roles);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        foreach($user->roles as $role) {
            $role = $role;
        }
        return response()->json([
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:30|min:5|regex:/^[A-Za-z0-9_]+$/|unique:users,user_name,' . $id,
            'email' => 'required|string|max:255|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:users,email,' . $id,
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->updated_by = Auth::user()->id;
            $user->save();


            if ($request->roles) {
                $user->roles()->detach();
                $user->assignRole($request->roles);
            }

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->updated_by = Auth::user()->id;
        $user->deleted_by = Auth::user()->id;
        $user->save();
        $user->delete();
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $query = User::onlyTrashed();

            $trashed_users = $query->orderBy('deleted_at', 'desc')->get();

            return DataTables::of($trashed_users)
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

        return view('admin.user.index');
    }

    public function restore(string $id)
    {
        User::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);

        User::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->forceDelete();
    }

    public function status(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->status == "Active") {
            $user->status = "Inactive";
        } else {
            $user->status = "Active";
        }

        $user->updated_by = Auth::user()->id;
        $user->save();
    }
}
