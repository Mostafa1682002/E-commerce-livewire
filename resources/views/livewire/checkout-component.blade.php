<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <form method="post" class="row" wire:submit.prevent="placeOrder()">
                        <div class="col-md-6">
                            <div class="mb-25">
                                <h4>Billing Details</h4>
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model="address" placeholder="Address *">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model="address2" placeholder="Address line2">
                                @error('address2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model="city" placeholder="City / Town *">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model="phone" placeholder="Phone *">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <h5>Additional information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes" wire:model="notes"></textarea>
                                @error('notes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Your Orders</h4>
                                </div>
                                @if (Cart::instance('cart')->count() > 0)
                                    <div class="table-responsive order_table text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Cart::instance('cart')->content() as $product)
                                                    <tr>
                                                        <td class="image product-thumbnail"><img
                                                                src="{{ $product->model->main_image_1 }}"
                                                                alt="#"></td>
                                                        <td>
                                                            <h5><a
                                                                    href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                                            </h5>
                                                            <span class="product-qty">x {{ $product->qty }}</span>
                                                        </td>
                                                        <td>${{ $product->subtotal }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>SubTotal</th>
                                                    <td class="product-subtotal" colspan="2">
                                                        ${{ Cart::instance('cart')->subtotal() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax</th>
                                                    <td class="product-subtotal" colspan="2">
                                                        ${{ Cart::instance('cart')->tax() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td colspan="2"><em>Free Shipping</em></td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    <td colspan="2" class="product-subtotal"><span
                                                            class="font-xl text-brand fw-900">${{ Cart::instance('cart')->total() }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    {{-- <div class="payment_method">
                                        <div class="mb-25">
                                            <h5>Payment</h5>
                                        </div>
                                        <div class="payment_option">
                                            <div class="custome-radio">
                                                <input class="form-check-input" required="" type="radio"
                                                    name="payment_option" id="exampleRadios3">
                                                <label class="form-check-label" for="exampleRadios3"
                                                    data-bs-toggle="collapse" data-target="#cashOnDelivery"
                                                    aria-controls="cashOnDelivery">Cash On
                                                    Delivery</label>
                                            </div>
                                            <div class="custome-radio">
                                                <input class="form-check-input" required="" type="radio"
                                                    name="payment_option" id="exampleRadios4">
                                                <label class="form-check-label" for="exampleRadios4"
                                                    data-bs-toggle="collapse" data-target="#cardPayment"
                                                    aria-controls="cardPayment">Card Payment</label>
                                            </div>
                                            <div class="custome-radio">
                                                <input class="form-check-input" required="" type="radio"
                                                    name="payment_option" id="exampleRadios5">
                                                <label class="form-check-label" for="exampleRadios5"
                                                    data-bs-toggle="collapse" data-target="#paypal"
                                                    aria-controls="paypal">Paypal</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Place
                                        Order</button>
                                @else
                                    <p class="text-center text-danger">Cart Is Empty</p>
                                    <a href="{{ route('shop') }}" class="btn btn-fill-out btn-block mt-30">Shop
                                        Now</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>
