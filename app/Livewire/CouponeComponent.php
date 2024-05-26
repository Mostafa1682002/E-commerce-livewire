<?php

namespace App\Livewire;

use App\Models\Coupone;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CouponeComponent extends Component
{

    public $code, $discount, $subtotalAfterDiscount, $totalAfterDiscount;


    public function applyCouponCode()
    {
        $this->validate(
            ['code' => 'required|string']
        );
        $coupon = Coupone::where('code', $this->code)->where('cart_value', '<=', str_replace(',', '', Cart::instance('cart')->total()))->first();
        if (!$coupon) {
            $this->dispatch('flashMessage', ['type' => 'error', 'message' => 'Coupon code is invalid!']);
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Success Apply Coupon']);
    }

    public function calculateDiscounts()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            // $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;
            // $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount;
        }
    }




    public function removeCoupon()
    {
        session()->forget('coupon');
        $this->dispatch('flashMessage', ['type' => 'success', 'message' => 'Success Remove Coupon code ']);
    }

    public function render()
    {
        return view('livewire.coupone-component')->layout('layouts.app');
    }
}