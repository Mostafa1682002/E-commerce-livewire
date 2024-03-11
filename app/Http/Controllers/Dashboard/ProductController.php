<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class ProductController extends Controller
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
        $data = Product::latest()->paginate(12);
        return view('Dashboard.Products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Dashboard.Products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => "required|string|max:255",
                    'slug' => "required|string|max:255",
                    'short_description' => "nullable|string|max:255",
                    'description' => "nullable|string",
                    'regular_price' => "required|numeric",
                    'sale_price' => "nullable|numeric",
                    'featured' => "required|boolean",
                    'status' => "required|boolean",
                    'quantity' => "required|integer",
                    'main_image_1' => "required|image|mimes:jpeg,png,jpg,gif",
                    'main_image_2' => "required|image|mimes:jpeg,png,jpg,gif",
                    'images.*' => "nullable|image|mimes:jpeg,png,jpg,gif",
                ]
            );
            $data = $request->except('main_image_1', 'main_image_2', 'images');
            $image1 = uniqid(5) . $request->file('main_image_1')->getClientOriginalName();
            $image2 = uniqid(5) . $request->file('main_image_1')->getClientOriginalName();

            $request->file('main_image_1')->storeAs('', $image1, 'products');
            $request->file('main_image_2')->storeAs('', $image2, 'products');

            $data['main_image_1'] = "uploads/products/" . $image1;
            $data['main_image_2'] = "uploads/products/" . $image2;

            $product = Product::create($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $name = uniqid(5) . $image->getClientOriginalName();
                    $image->storeAs('', $name, 'products');
                    $product->images()->create(['image' => "uploads/products/$name"]);
                }
            }
            return redirect()->route('admin.products.index')->with('success', 'Success Add Product');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        // return $product;
        return view('Dashboard.Products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('Dashboard.Products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $request->validate(
                [
                    'name' => "required|string|max:255",
                    'slug' => "required|string|max:255",
                    'short_description' => "nullable|string|max:255",
                    'description' => "nullable|string",
                    'regular_price' => "required|numeric",
                    'sale_price' => "nullable|numeric",
                    'featured' => "required|boolean",
                    'status' => "required|boolean",
                    'quantity' => "required|integer",
                    'main_image_1' => "nullable|image|mimes:jpeg,png,jpg,gif",
                    'main_image_2' => "nullable|image|mimes:jpeg,png,jpg,gif",
                    'images.*' => "nullable|image|mimes:jpeg,png,jpg,gif",
                ]
            );
            $data = $request->except('main_image_1', 'main_image_2', 'images');

            if ($request->hasFile('main_image_1')) {
                $image1 = uniqid(5) . $request->file('main_image_1')->getClientOriginalName();
                $request->file('main_image_1')->storeAs('', $image1, 'products');
                $data['main_image_1'] = "uploads/products/" . $image1;
                //Delete Old Images
                File::delete(ltrim(parse_url($product->main_image_1)['path'], '/'));
            }

            if ($request->hasFile('main_image_2')) {
                $image2 = uniqid(5) . $request->file('main_image_2')->getClientOriginalName();
                $request->file('main_image_2')->storeAs('', $image2, 'products');
                $data['main_image_2'] = "uploads/products/" . $image2;
                //Delete Old Images
                File::delete(ltrim(parse_url($product->main_image_2)['path'], '/'));
            }


            if ($request->hasFile('images')) {
                //Delete Old Images
                if (count($product->images)) {
                    foreach ($product->images as $image) {
                        File::delete(ltrim(parse_url($image->image)['path'], '/'));
                    }
                }
                //Add New Images
                foreach ($request->file('images') as $image) {
                    $name = uniqid(5) . $image->getClientOriginalName();
                    $image->storeAs('', $name, 'products');
                    $product->images()->create(['image' => "uploads/products/$name"]);
                }
            }

            $product->update($data);
            return redirect()->route('admin.products.index')->with('success', 'Success Update Product');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            File::delete(ltrim(parse_url($product->main_image_1)['path'], '/'));
            File::delete(ltrim(parse_url($product->main_image_2)['path'], '/'));
            if (count($product->images)) {
                foreach ($product->images as $image) {
                    File::delete(ltrim(parse_url($image->image)['path'], '/'));
                }
            }
            $product->delete();
            return redirect()->back()->with('success', 'Success Delete Product');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
