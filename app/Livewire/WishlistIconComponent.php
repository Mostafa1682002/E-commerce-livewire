<?php

namespace App\Livewire;

use Livewire\Component;

class WishlistIconComponent extends Component
{
    protected $listeners = ['wishlistIcon' => '$refresh'];
    public function render()
    {
        return view('livewire.wishlist-icon-component')->layout('layouts.app');
    }
}
