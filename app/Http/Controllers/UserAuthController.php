<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:web'])->only('login_form', 'register_form');
        $this->middleware(['auth:web', 'check_status_user'])->only('logout');
    }


    public function login_form()
    {
        return view('login');
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
            if (auth('web')->attempt($request->only('email', 'password'), $request->remember ?? false)) {
                if (auth()->user()->status->user() == 'Disactive') {
                    auth()->logout();
                    return redirect()->back()->withInput($request->only('email'))->with('success', 'Your Account Is Not Active');
                }
                return redirect()->route('home')->with('success', 'Success Login');
            }
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid Data');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function register_form()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => "required|string|max:255",
                    'email' => 'required|email|unique:users,email',
                    'phone' => "required|unique:users,phone",
                    'password' => "required|string|confirmed|min:6",
                ]
            );
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
            auth('web')->login($user);
            return redirect()->route('home')->with('success', 'Success Registration ');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home')->with('success', 'Success Logout');
    }
}
