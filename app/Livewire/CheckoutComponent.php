<?php

namespace App\Livewire;

use App\Events\OrderNotification;
use App\Jobs\NewOrderJob;
use App\Livewire\Dashboard\HeaderComponent;
use App\Models\Admin;
use App\Models\Order;
use App\Notifications\NewOrder;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $title = 'Checkout';

    public $user;
    public $phone;
    public $address = '';
    public $address2 = '';
    public $city = '';
    public $notes = '';
    public $discount = 0, $totalAfterDiscount;



    public function mount()
    {
        $this->user = auth()->user();
        $this->phone = $this->user->phone;
    }

    public function placeOrder()
    {
        $this->validate([
            'phone' => "required|max:20",
            'address' => "required|max:255",
            'address2' => "nullable|max:255",
            'city' => "required|string|max:255",
            'notes' => "nullable|max:500",
        ]);

        $order = $this->user->orders()->create([
            'phone' => $this->phone,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'notes' => $this->notes,
            'subtotal' => str_replace(',', '', Cart::instance('cart')->subtotal()),
            'tax' => Cart::instance('cart')->tax(),
            'total' => str_replace(',', '', Cart::instance('cart')->total()) - $this->discount,
            'discount' => $this->discount,
        ]);


        foreach (Cart::instance('cart')->content() as $item) {
            $product = [
                $item->id => [
                    'qty' => $item->qty,
                    'price' => $item->price,
                ]
            ];
            $order->products()->attach($product);
        }

        //Dispatch Job
        dispatch(new NewOrderJob($order));
        //Delete Item from Cart
        Cart::instance('cart')->destroy();
        $this->dispatch('noti');
        session()->forget('coupon');
        return redirect()->route('home')->with('success', 'Success Apply Order');
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
        return view('livewire.checkout-component')
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
