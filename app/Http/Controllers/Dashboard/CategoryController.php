<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $data = Category::latest()->paginate(9);
        return view('Dashboard.categories', compact('data'));
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
            $validator = Validator::make($request->all(), [
                'name' => "required|string|max:255|unique:categories,name",
                'slug' => "required|string|max:255|unique:categories,slug",
            ]);
            Category::create($validator->validated());
            return redirect()->back()->with('success', 'Success Add Category');
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
            $validator = Validator::make($request->all(), [
                'name' => "required|string|max:255|unique:categories,name,$id",
                'slug' => "required|string|max:255|unique:categories,slug,$id",
            ]);
            Category::findOrFail($id)->update($validator->validated());
            return redirect()->back()->with('success', 'Success Update Category');
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
            Category::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Delete Category');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
