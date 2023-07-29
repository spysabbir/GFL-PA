<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard () {
        return view('admin.dashboard');
    }

    public function profile(Request $request)
    {
        return view('admin.profile.index', [
            'user' => $request->user(),
        ]);
    }
}
