<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $setting = Setting::first();
        return view('Dashboard.setting', compact('setting'));
    }
    public function update(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:100',
                'address' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'ins_link' => "nullable|url",
                'tw_link' => "nullable|url",
                'face_link' => "nullable|url",
                'you_link' => "nullable|url",
                'logo' => "nullable|image|mimes:jpeg,png,jpg,gif",
            ]);

            $data = $request->except('logo');
            $setting = Setting::first();
            if ($request->hasFile('logo')) {
                File::delete(ltrim(parse_url($setting->logo)['path'], '/'));
                $name = uniqid(5) . $request->file('logo')->getClientOriginalName();
                $request->file('logo')->storeAs('', $name, 'logo');
                $data['logo'] = "uploads/logo/" .   $name;
            }

            $setting->update($data);
            return redirect()->back()->with('success', 'Successfuly Update Data');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
