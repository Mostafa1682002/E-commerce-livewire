<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomeComponent extends Component
{
    public $title = "Home";
    //Add Item To Cart
    public function addCart($id)
    {
        $product = Product::findOrFail($id);
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('\App\Models\Product');
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Item Added To Cart']);
        $this->dispatch('refreshCartIcon');
    }

    //Add Item To Wishlist
    public function addWishlist($id)
    {
        $product = Product::findOrFail($id);
        Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->regular_price)->associate('\App\Models\Product');
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Item Added To Wishlist']);
        $this->dispatch('wishlistIcon');
    }

    //Remove Item From Wishlist
    public function removeWishlist($idProduct)
    {
        $rowId = Cart::instance('wishlist')->content()->where('id', $idProduct)->first()->rowId;
        Cart::instance('wishlist')->remove($rowId);
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Item Removed From Wishlist']);
        $this->dispatch('wishlistIcon');
    }
    public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        $new_products = Product::latest()->limit(8)->get();
        $f_products = Product::where('featured', 1)->inRandomOrder()->limit(8)->get();
        $p_products = Product::inRandomOrder()->limit(8)->get();
        $wishlist = Cart::instance('wishlist')->content()->pluck('id');
        $categoires = Category::inRandomOrder()->limit(8)->get();
        return view(
            'livewire.home-component',
            compact('sliders', 'new_products', 'f_products', 'p_products', 'wishlist', 'categoires')
        )
            ->layout('layouts.app', ['title' => $this->title]);
    }
}