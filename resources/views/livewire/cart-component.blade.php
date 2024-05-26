<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if (Cart::instance('cart')->count() > 0)
                            <div class="table-responsive">
                                <table class="table shopping-summery text-center clean">
                                    <thead>
                                        <tr class="main-heading">
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ $item->model->main_image_1 }}"
                                                        alt="{{ $item->name }}">
                                                </td>
                                                <td class="product-des product-name">
                                                    <h5 class="product-name"><a
                                                            href="{{ route('product.details', $item->id) }}">{{ $item->name }}</a>
                                                    </h5>
                                                </td>
                                                <td class="price" data-title="Price"><span>${{ $item->price }} </span>
                                                </td>
                                                <td class="text-center" data-title="Stock">
                                                    <div class="detail-qty border radius  m-auto">
                                                        <a href="#"
                                                            wire:click.prevent="decreaseItem('{{ $item->rowId }}')"
                                                            class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                        <span class="qty-val">{{ $item->qty }}</span>
                                                        <a href="#"
                                                            wire:click.prevent="increaseItem('{{ $item->rowId }}')"
                                                            class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                    </div>
                                                </td>
                                                <td class="text-right" data-title="Cart">
                                                    <span>${{ $item->subtotal }} </span>
                                                </td>
                                                <td class="action" data-title="Remove"><a href="#"
                                                        wire:click.prevent="removeCart('{{ $item->rowId }}')"
                                                        class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="text-end">
                                                <a href="#" wire:click.prevent="removeAllItems"
                                                    class="text-muted">
                                                    <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-action text-end">
                                <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>Update Cart</a>
                                <a class="btn" href="{{ route('checkout') }}"><i
                                        class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                            </div>
                            <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                            <div class="row mb-50">
                                <div class="col-lg-6 col-md-12">
                                    <div class="mb-30 mt-50">
                                        <div class="heading_s1 mb-3">
                                            <h4>Apply Coupon</h4>
                                        </div>
                                        <div class="total-amount">
                                            <div class="left">
                                                <div class="coupon">
                                                    <form action="#" wire:submit.prevent="applyCouponCode">
                                                        @if (session()->has('coupon'))
                                                            <div class="form-row row justify-content-center">
                                                                <div class="form-group col-lg-6">
                                                                    <input class="font-medium" name="code"
                                                                        value="{{ session('coupon')['code'] }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <button wire:click.prevent="removeCoupon"
                                                                        class="btn btn-sm"><i
                                                                            class="fi-rs-trash mr-10"></i>Remove
                                                                        Coupon</button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="form-row row justify-content-center">
                                                                <div class="form-group col-lg-6">
                                                                    <input class="font-medium" wire:model="code"
                                                                        name="code" placeholder="Enter Your Coupon">
                                                                    @error('code')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <button type="submit" class="btn  btn-sm"><i
                                                                            class="fi-rs-label mr-10"></i>Apply</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="border p-md-4 p-30 border-radius cart-totals">
                                        <div class="heading_s1 mb-3">
                                            <h4>Cart Totals</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="cart_total_label">Cart Subtotal</td>
                                                        <td class="cart_total_amount"><span
                                                                class="font-lg fw-900 text-brand">${{ Cart::subtotal() }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Tax</td>
                                                        <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>
                                                            ${{ Cart::tax() }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Shipping</td>
                                                        <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>
                                                            Free Shipping
                                                        </td>
                                                    </tr>
                                                    @if (session()->has('coupon'))
                                                        <tr>
                                                            <td class="cart_total_label">Discount</td>
                                                            <td class="cart_total_amount"><strong><span
                                                                        class="font-xl fw-900 text-brand">-
                                                                        ${{ $discount }}</span></strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cart_total_label">Total</td>
                                                            <td class="cart_total_amount"><strong><span
                                                                        class="font-xl fw-900 text-brand">${{ $totalAfterDiscount }}</span></strong>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td class="cart_total_label">Total</td>
                                                            <td class="cart_total_amount"><strong><span
                                                                        class="font-xl fw-900 text-brand">${{ Cart::instance('cart')->total() }}</span></strong>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <a href="{{ route('checkout') }}" class="btn "> <i
                                                class="fi-rs-box-alt mr-10"></i>
                                            Proceed To CheckOut</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h1 class="text-center">No Item In Cart</h1>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
