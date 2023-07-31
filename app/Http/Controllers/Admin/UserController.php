<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['roles', 'action'])
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
            ]);

            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);
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
            $user->save();

            $user->roles()->detach();

            if ($request->roles) {
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
        $user->delete();
    }
}
