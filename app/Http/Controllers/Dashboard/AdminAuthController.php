<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('auth:admin')->only('logout');
    }
    public function login_form()
    {
        return view('Dashboard.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => "required|string"
                ]
            );
            if (auth('admin')->attempt($request->only('email', 'password'), $request->remember ?? false)) {
                return redirect()->route('admin.home')->with('success', 'Success Login');
            }
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid Data');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.home')->with('success', 'Success Logout');
    }
}
