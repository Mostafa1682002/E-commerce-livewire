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
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>
                                    We found <strong class="text-brand">{{ $products->total() }}</strong> items for
                                    you!
                                </p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $sizeProducts }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $sizeProducts == 12 ? 'active' : '' }}"
                                                    wire:click.prevent="show(12)" href="#">12</a>
                                            </li>
                                            <li><a class="{{ $sizeProducts == 24 ? 'active' : '' }}" href="#"
                                                    wire:click.prevent="show(24)">24</a></li>
                                            <li><a class="{{ $sizeProducts == 36 ? 'active' : '' }}" href="#"
                                                    wire:click.prevent="show(36)">36</a></li>
                                            <li><a class="{{ $sizeProducts == 48 ? 'active' : '' }}" href="#"
                                                    wire:click.prevent="show(48)">48</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span>
                                                {{ $sort }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $sort == 'Default Sorting' ? 'active' : '' }}"
                                                    wire:click.prevent="orderProductsBy('Default Sorting')"
                                                    href="#">Default Sorting</a></li>
                                            <li><a class="{{ $sort == 'Price: Low to High' ? 'active' : '' }}"
                                                    wire:click.prevent="orderProductsBy('Price: Low to High')"
                                                    href="#">Price: Low to High</a></li>
                                            <li><a class="{{ $sort == 'Price: High to Low' ? 'active' : '' }}"
                                                    wire:click.prevent="orderProductsBy('Price: High to Low')"
                                                    href="#">Price: High to Low</a></li>
                                            <li><a class="{{ $sort == 'Sort By Newness' ? 'active' : '' }}"
                                                    wire:click.prevent="orderProductsBy('Sort By Newness')"
                                                    href="#">Sort By Newness</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @forelse($products as $product)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
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
                                                $date_create = \Carbon\Carbon::parse(date('Y-m-d', strtotime($product->created_at)));
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
                                                @if ($wishlist->contains($product->id))
                                                    <a aria-label="Remove From Wishlist"
                                                        class="action-btn hover-up wishlisted" href="#"
                                                        wire:click.prevent="removeWishlist({{ $product->id }})"><i
                                                            class="fi-rs-heart"></i></a>
                                                @else
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                        href="#"
                                                        wire:click.prevent="addWishlist({{ $product->id }})"><i
                                                            class="fi-rs-heart"></i></a>
                                                @endif
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
                        <!--pagination-->
                        {{-- <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item active">
                                        <a class="page-link" href="#">01</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">02</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">03</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link dot" href="#">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">16</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i
                                                class="fi-rs-angle-double-small-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div> --}}
                        {{ $products->links() }}
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">
                                Category
                            </h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                    <li><a href="#"
                                            wire:click.prevent="changeCategory({{ $category->id }})">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Fillter by price</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range" wire:ignore></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>Range:</span> <span class="text-info">$ {{ $min_value }}</span> -
                                            <span class="text-info">$ {{ $max_value }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900">Color</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox1" value="" />
                                        <label class="form-check-label" for="exampleCheckbox1"><span>Red
                                                (56)</span></label>
                                        <br />
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox2" value="" />
                                        <label class="form-check-label" for="exampleCheckbox2"><span>Green
                                                (78)</span></label>
                                        <br />
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox3" value="" />
                                        <label class="form-check-label" for="exampleCheckbox3"><span>Blue
                                                (54)</span></label>
                                    </div>
                                    <label class="fw-900 mt-15">Item Condition</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox11" value="" />
                                        <label class="form-check-label" for="exampleCheckbox11"><span>New
                                                (1506)</span></label>
                                        <br />
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox21" value="" />
                                        <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished
                                                (27)</span></label>
                                        <br />
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox31" value="" />
                                        <label class="form-check-label" for="exampleCheckbox31"><span>Used
                                                (45)</span></label>
                                    </div>
                                </div>
                            </div>
                            <a href="shop.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                                Fillter</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div>


@push('js')
    <script>
        var sliderrange = $('#slider-range');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 0,
                max: 1000,
                values: [0, 1000],
                slide: function(event, ui) {
                    @this.set('min_value', ui.values[0]);
                    @this.set('max_value', ui.values[1]);
                }
            });
        });
    </script>
@endpush

@if (session('success_wishlist'))
    @script
        <script>
            toastr.success("{{ session('success_wishlist') }}");
        </script>
    @endscript
@endif
@if (session('success_wishlist_r'))
    @script
        <script>
            toastr.success("{{ session('success_wishlist_r') }}");
        </script>
    @endscript
@endif
