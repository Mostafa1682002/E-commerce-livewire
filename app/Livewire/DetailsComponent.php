<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $title = "Details Product";
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }


    //Add Item To Cart
    public function addCart($id)
    {
        $product = Product::findOrFail($id);
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('\App\Models\Product');
        return redirect()->route('cart')->with('success', 'Item Added To Cart');
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



    public function render()
    {
        $product = Product::findOrFail($this->id);
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $news_products = Product::latest()->take(4)->get();
        $wishlist = Cart::instance('wishlist')->content()->pluck('id');
        $categories = Category::all();
        return view(
            'livewire.details-component',
            compact('product', 'related_products', 'news_products', 'categories', 'wishlist')
        )
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
