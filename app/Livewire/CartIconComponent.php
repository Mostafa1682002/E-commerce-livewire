<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartIconComponent extends Component
{
    protected $listeners = ['refreshCartIcon' => '$refresh'];


    //Remove Item From Cart
    public function removeCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Removed Item From Cart']);
        $this->dispatch('refreshCart');
    }

    public function render()
    {
        return view('livewire.cart-icon-component')->layout('layouts.app');
    }
}