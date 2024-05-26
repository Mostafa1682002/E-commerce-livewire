<div>
    <style>
        .wishlisted {
            background-color: #f15412 !important;
            border: 1px solid transparent !important;
        }

        .wishlisted i {
            color: #fff !important;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Wishlist
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">

                    <div class="row product-grid-4">
                        @forelse($products as $product)
                            <div class="col-lg-3 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.details', $product->id) }}">
                                                <img class="default-img" src="{{ $product->main_image_1 }}"
                                                    alt="" />
                                                <img class="hover-img" src="{{ $product->main_image_2 }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        @php
                                            $date_create = \Carbon\Carbon::parse(
                                                date('Y-m-d', strtotime($product->created_at)),
                                            );
                                            $date_now = \Carbon\Carbon::parse(date('Y-m-d'));
                                            $diffInDays = $date_create->diffInDays($date_now);
                                        @endphp
                                        @if ($diffInDays < 5)
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="new">New</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product_info">
                                            <div class="product-category">
                                                <span>{{ $product->category->name }}</span>
                                            </div>
                                            <h2>
                                                <a
                                                    href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                            </h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>${{ $product->regular_price }} </span>
                                                <span class="old-price">$245.8</span>
                                            </div>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted"
                                                href="#"
                                                wire:click.prevent="removeWishlist({{ $product->id }})"><i
                                                    class="fi-rs-heart"></i></a>
                                            <a aria-label="Add To Cart" class="action-btn hover-up" href="#"
                                                wire:click.prevent="addCart({{ $product->id }})"><i
                                                    class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No Item Found</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </section>
    </main>
</div>
