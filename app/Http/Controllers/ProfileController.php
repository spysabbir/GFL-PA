<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
        ]);

        $request->user()->update([
            'name' => $request->name,
        ]);

        return back()->with('status', 'profile-updated');
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

        return back()->with('status', 'password-updated');
    }
}
