<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public $title = 'Shop';
    public $sizeProducts = 12;
    public $sort = 'Default Sorting';
    public $category;
    public $search;
    public $search_item = '';
    public $min_value = 0;
    public $max_value = 1000;

    public function mount()
    {
        $this->fill(request()->only('search'));
        $this->search_item =  $this->search;
    }



    //Add Item To Cart
    public function addCart($id)
    {
        $product = Product::findOrFail($id);
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('\App\Models\Product');
        return redirect()->route('cart')->with('success_cart', 'Item Added To Cart');
    }

    //Add Item To Wishlist
    public function addWishlist($id)
    {
        $product = Product::findOrFail($id);
        Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->regular_price)->associate('\App\Models\Product');
        session()->flash('success_wishlist', 'Item Added To Wishlist');
        $this->dispatch('wishlistIcon');
    }

    //Remove Item From Wishlist
    public function removeWishlist($idProduct)
    {
        $rowId = Cart::instance('wishlist')->content()->where('id', $idProduct)->first()->rowId;
        Cart::instance('wishlist')->remove($rowId);
        session()->flash('success_wishlist_r', 'Item Removed From Wishlist');
        $this->dispatch('wishlistIcon');
    }


    public function show($n)
    {
        $this->sizeProducts = $n;
    }
    public function orderProductsBy($s)
    {
        $this->sort = $s;
    }
    public function changeCategory($id)
    {
        $this->category = $id;
    }


    public function render()
    {
        $category_id = $this->category;
        $search_name = $this->search_item;
        if ($this->sort == 'Price: Low to High') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])
                ->where(function ($query) use ($category_id, $search_name) {
                    //filter Category
                    if ($category_id) {
                        $query->where('category_id', $category_id);
                    }
                    //Search
                    if ($search_name) {
                        $query->where('name', 'like', '%' . $search_name . '%');
                    }
                })->orderBy('regular_price', 'ASC')->paginate($this->sizeProducts);
        } elseif ($this->sort == 'Price: High to Low') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])
                ->where(function ($query) use ($category_id, $search_name) {
                    //filter Category
                    if ($category_id) {
                        $query->where('category_id', $category_id);
                    }
                    //Search
                    if ($search_name) {
                        $query->where('name', 'like', '%' . $search_name . '%');
                    }
                })->orderBy('regular_price', 'DESC')->paginate($this->sizeProducts);
        } elseif ($this->sort == 'Sort By Newness') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])
                ->where(function ($query) use ($category_id, $search_name) {
                    //filter Category
                    if ($category_id) {
                        $query->where('category_id', $category_id);
                    }
                    //Search
                    if ($search_name) {
                        $query->where('name', 'like', '%' . $search_name . '%');
                    }
                })->orderBy('created_at', 'DESC')->paginate($this->sizeProducts);
        } else {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])
                ->where(function ($query) use ($category_id, $search_name) {
                    //filter Category
                    if ($category_id) {
                        $query->where('category_id', $category_id);
                    }
                    //Search
                    if ($search_name) {
                        $query->where('name', 'like', '%' . $search_name . '%');
                    }
                })->paginate($this->sizeProducts);
        }

        $categories = Category::all();
        $wishlist = Cart::instance('wishlist')->content()->pluck('id');
        return view('livewire.shop-component', compact('products', 'categories', 'wishlist'))
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
