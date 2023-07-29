<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard () {
        return view('employee.dashboard');
    }

    public function profile(Request $request)
    {
        return view('employee.profile.index', [
            'user' => $request->user(),
        ]);
    }
}
