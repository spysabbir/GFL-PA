<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create() {
        return view('admin.user.create');
    }

    public function store (Request $request) {

        $validator = Validator::make($request->all(), [
            'employee_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:30', 'min:3', 'regex:/^[A-Za-z0-9_]+$/', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            User::create([
                'employee_id' => $request->employee_id,
                'name' => $request->name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make('12345678'),
            ]);

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $query = User::select('users.*');

            $query->orderBy('created_at', 'desc');

            $users = $query->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn text-white bg-purple btn-sm editBtn" data-toggle="modal" data-target="#editModal"><i class="fe fe-edit"></i></button>
                            <button type="button" data-id="' . $row->id . '" class="btn text-white bg-yellow btn-sm deleteBtn"><i class="fe fe-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.index');
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
            'email' => 'required|string|max:255|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $user = User::findOrFail($id);
            $user->update($request->all());

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function delete(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
