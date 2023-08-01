<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        return view('employee.profile.index', [
            'user' => $request->user(),
            'employee' => Employee::find($request->user()->employee_id),
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profile_photo' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        // User Data
        $request->user()->update([
            'name' => $request->name,
        ]);

        // Employee Data
        $employee = Employee::find($request->user()->employee_id);
        $employee->update([
            'name' => $request->name,
            'emergency_phone_number' => $request->emergency_phone_number,
            'address' => $request->address,
        ]);

        // Profile Photo Upload
        if($request->hasFile('profile_photo')){
            if($employee->profile_photo != "default_profile_photo.png"){
                unlink(base_path("public/uploads/profile_photo/").$employee->profile_photo);
            }
            $profile_photo_name =  "Employee-Profile-Photo-".$employee->id.".". $request->file('profile_photo')->getClientOriginalExtension();
            $upload_link = base_path("public/uploads/profile_photo/").$profile_photo_name;
            Image::make($request->file('profile_photo'))->resize(120,120)->save($upload_link);
            $employee->update([
                'profile_photo' => $profile_photo_name,
                'updated_by' => Auth::user()->id,
            ]);
        }

        $notification = array(
            'message' => 'Profile updated successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password', 'min:6'],
            'password' => ['required', Password::defaults(), 'confirmed', 'min:6'],
            'password_confirmation' => ['required', Password::defaults(), 'min:6'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        $notification = array(
            'message' => 'Password updated successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
}
