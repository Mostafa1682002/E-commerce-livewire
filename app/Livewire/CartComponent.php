<?php

namespace App\Livewire;

use App\Models\Coupone;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $title = 'Cart';
    protected $listeners = ['refreshCart' => '$refresh'];
    public $code, $discount, $totalAfterDiscount;

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




    public function applyCouponCode()
    {
        $this->validate(
            ['code' => 'required|string']
        );
        $coupon = Coupone::where('code', $this->code)
            ->where('expiry_date', '>=', Carbon::today())
            ->where('cart_value', '<=', str_replace(',', '', Cart::instance('cart')->total()))
            ->first();


        if (!$coupon) {
            session()->flash('coupon_error', 'Coupon code is invalid!');
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
        session()->flash('coupon_success', 'Success Apply Coupon');
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
        session()->flash('coupon_success', 'Success Remove Coupon code ');
    }





    public function render()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (str_replace(',', '', Cart::instance('cart')->total()) * session()->get('coupon')['value']) / 100;
            }
            $this->totalAfterDiscount = str_replace(',', '', Cart::instance('cart')->total()) - $this->discount;
        }
        return view('livewire.cart-component')
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
