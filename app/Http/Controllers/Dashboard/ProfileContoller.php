<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ProfileContoller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'auto_check_premission']);
    }


    public function profile()
    {
        $data = auth('admin')->user();
        return view('Dashboard.profile', compact('data'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => "required|string",
                    'email' => "required|email|unique:admins,email," . auth()->user()->id,
                    'password' => "nullable|string|min:5"
                ]
            );

            $data = $request->only('name', 'email');
            if ($request->password != null) {
                $data['password'] = bcrypt($request->password);
            }
            auth('admin')->user()->update($data);
            return redirect()->back()->with('success', 'Success Update Profile');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
