@extends('layouts.master', ['title' => 'Details Product'])

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="bx bx-home-alt"></i></a>
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                        <li class="breadcrumb-item active" aria-current="page">Details Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 border-end">
                    <img src="{{ asset($product->main_image_1) }}" class="img-fluid" alt="...">
                    <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                        <div class="col"><img src="{{ asset($product->main_image_1) }}" width="70"
                                class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="{{ asset($product->main_image_2) }}" width="70"
                                class="border rounded cursor-pointer" alt=""></div>
                        @foreach ($product->images as $image)
                            <div class="col"><img src="{{ asset($image->name) }}" width="70"
                                    class="border rounded cursor-pointer" alt=""></div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <div class="d-flex gap-3 py-3">
                            <div class="cursor-pointer">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-secondary"></i>
                            </div>
                            <div>142 reviews</div>
                            <div class="text-success"><i class="bx bxs-cart-alt align-middle"></i> 134 orders</div>
                        </div>
                        <div class="mb-3">
                            <span class="price h4">${{ $product->regular_price }}</span>
                            <span class="text-muted">/per kg</span>
                        </div>
                        <p class="card-text fs-6">{{ $product->short_description }}</p>
                        {{--
                        <dl class="row">
                            <dt class="col-sm-3">Model#</dt>
                            <dd class="col-sm-9">Odsy-1000</dd>

                            <dt class="col-sm-3">Color</dt>
                            <dd class="col-sm-9">Brown</dd>

                            <dt class="col-sm-3">Delivery</dt>
                            <dd class="col-sm-9">Russia, USA, and Europe </dd>
                        </dl>
                        <hr>
                        <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                            <div class="col">
                                <label class="form-label">Quantity</label>
                                <div class="input-group input-spinner">
                                    <button class="btn btn-white" type="button" id="button-plus"> + </button>
                                    <input type="text" class="form-control" value="1">
                                    <button class="btn btn-white" type="button" id="button-minus"> − </button>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label">Select size</label>
                                <div class="">
                                    <label class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="select_size" checked="">
                                        <div class="form-check-label">Small</div>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="select_size" checked="">
                                        <div class="form-check-label">Medium</div>
                                    </label>

                                    <label class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="select_size" checked="">
                                        <div class="form-check-label">Large</div>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label">Select Color</label>
                                <div class="color-indigators d-flex align-items-center gap-2">
                                    <div class="color-indigator-item bg-primary"></div>
                                    <div class="color-indigator-item bg-danger"></div>
                                    <div class="color-indigator-item bg-success"></div>
                                    <div class="color-indigator-item bg-warning"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-3">
                            <a href="#" class="btn btn-primary">Buy Now</a>
                            <a href="#" class="btn btn-outline-primary"><span class="text">Add to cart</span> <i
                                    class="bx bxs-cart-alt"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                            aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-comment-detail font-18 me-1"></i>
                                </div>
                                <div class="tab-title"> Product Description </div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                            aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-bookmark-alt font-18 me-1"></i>
                                </div>
                                <div class="tab-title">Tags</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                            aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-star font-18 me-1"></i>
                                </div>
                                <div class="tab-title">Reviews</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                            Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four
                            loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk
                            aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore
                            aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente
                            labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard
                            ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher
                            vero sint qui sapiente accusamus tattooed echo park.</p>
                    </div>
                    <div class="tab-pane fade " id="primarycontact" role="tabpanel">
                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo
                            retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft
                            beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR
                            banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever
                            gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you
                            probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu
                            synth chambray yr.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



@push('js')
@endpush
