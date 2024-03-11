<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'auto_check_premission']);
    }

    public function index()
    {
        $data = User::paginate(10);
        return view('Dashboard.users', compact('data'));
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate(['status' => "required|boolean"]);
            User::findOrFail($id)->update($request->only('status'));
            return redirect()->back()->with('success', 'Success Update User');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Delete User');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
