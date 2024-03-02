<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $title = 'Cart';
    protected $listeners = ['refreshCart' => '$refresh'];

    //Increase Quantity Item In Cart
    public function increaseItem($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        session()->flash('success_cart', 'Update Quantity Of Item');
        $this->dispatch('refreshCartIcon');
    }

    //Decrease Quantity Item In Cart
    public function decreaseItem($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        session()->flash('success_cart', 'Update Quantity Of Item');
        $this->dispatch('refreshCartIcon');
    }


    //Remove Item From Cart
    public function removeCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        session()->flash('success_cart', 'Removed Item From Cart');
        $this->dispatch('refreshCartIcon');
    }

    //Remove All Item From Cart
    public function removeAllItems()
    {
        Cart::instance('cart')->destroy();
        session()->flash('success_cart', 'Removed All Items From Cart');
        $this->dispatch('refreshCartIcon');
    }

    public function render()
    {
        return view('livewire.cart-component')
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
