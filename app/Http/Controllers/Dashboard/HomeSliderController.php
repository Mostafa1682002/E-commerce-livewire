<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeSliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin', 'auto_check_premission']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HomeSlider::latest()->paginate(10);
        return view('Dashboard.slider', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'top_title' => "required|string|max:255",
                'title' => "required|string|max:255",
                'sub_title' => "required|string|max:255",
                'offer' => "required|string|max:255",
                'image' => "required|image|mimes:jpeg,png,jpg,gif",
            ]);

            $data = $request->except('image');
            $name = uniqid(5) . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('', $name, 'slider');
            $data['image'] = "uploads/slider/" . $name;
            HomeSlider::create($data);
            return redirect()->back()->with('success', 'Success Add Slider Home');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $slider = HomeSlider::findOrFail($id);
            $request->validate([
                'top_title' => "required|string|max:255",
                'title' => "required|string|max:255",
                'sub_title' => "required|string|max:255",
                'offer' => "required|string|max:255",
                'image' => "nullable|image|mimes:jpeg,png,jpg,gif",
                'status' => "required|boolean"
            ]);

            $data = $request->except('image');
            if ($request->hasFile('image')) {
                File::delete(ltrim(parse_url($slider->image)['path'], '/'));
                $name = uniqid(5) . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('', $name, 'slider');
                $data['image'] = "uploads/slider/" . $name;
            }
            $slider->update($data);
            return redirect()->back()->with('success', 'Success Add Slider Home');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = HomeSlider::findOrFail($id);
            File::delete(ltrim(parse_url($slider->image)['path'], '/'));
            $slider->delete();
            return redirect()->back()->with('success', 'Success Delete Slider Home');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
