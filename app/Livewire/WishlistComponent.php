<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component
{
    public $title = "Wishlist";

    //Add Item To Cart
    public function addCart($id)
    {
        $product = Product::findOrFail($id);
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('\App\Models\Product');
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Item Added To Cart']);
        // return redirect()->route('cart')->with('success_cart', 'Item Added To Cart');
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
        $wishlist_ids = Cart::instance('wishlist')->content()->pluck('id');
        $products = Product::whereIn('id', $wishlist_ids)->get();
        return view('livewire.wishlist-component', compact('products'))
            ->layout('layouts.app', ['title' => $this->title]);
    }
}