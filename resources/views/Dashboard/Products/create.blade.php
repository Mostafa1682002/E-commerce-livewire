@extends('layouts.master', ['title' => 'New Product'])
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
                        <li class="breadcrumb-item active" aria-current="page">New Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Product</h5>
                <hr>
                <form class="form-body mt-4" method="POST" action="{{ route('admin.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" id="inputProductTitle"
                                        placeholder="Enter product Name" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="inputProductTitle"
                                        placeholder="Enter product Slug" value="{{ old('slug') }}">
                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="inputProductDescription" rows="3">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="inputProductDescription" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Main Image 1</label>
                                    <input name="main_image_1" type="file" class="dropify" data-height="100"
                                        accept=".jpg, .png, image/jpeg, image/png" />
                                    @error('main_image_1')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Main Image 2</label>
                                    <input name="main_image_2" type="file" class="dropify" data-height="100"
                                        accept=".jpg, .png, image/jpeg, image/png" />
                                    @error('main_image_2')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Images</label>
                                    <input name="images[]" type="file" class="dropify" data-height="100" multiple
                                        accept=".jpg, .png, image/jpeg, image/png" />
                                    @error('images')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputPrice" class="form-label">Regular Price</label>
                                        <input type="number" name="regular_price" step="any" class="form-control"
                                            id="inputPrice" placeholder="00.00" value="{{ old('regular_price') }}">
                                        @error('regular_price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCompareatprice" class="form-label">Sale Price</label>
                                        <input type="number" name="sale_price" step="any" class="form-control"
                                            id="inputCompareatprice" placeholder="00.00"
                                            value="{{ old('sale_price') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCompareatprice" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control"
                                            id="inputCompareatprice" placeholder="00" value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputProductType" class="form-label">Category</label>
                                        <select class="form-select" name="category_id" id="inputProductType">
                                            <option selected disabled>--select category --</option>
                                            @foreach ($categories as $category)
                                                <option @selected($category->id == old('category_id')) value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputVendor" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="inputVendor">
                                            <option selected disabled>--select Status --</option>
                                            @foreach (collect(\App\enums\StatusProduct::cases())->toArray() as $status)
                                                <option @selected($status == old('status')) value="{{ $status }}">
                                                    {{ $status->product() }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Featured</label>
                                        <select class="form-select" name="featured" id="inputCollection">
                                            <option selected disabled>--select Status --</option>
                                            @foreach (collect(\App\enums\StatusProduct::cases())->toArray() as $status)
                                                <option @selected($status == old('featured')) value="{{ $status }}">
                                                    {{ $status->featured() }}</option>
                                            @endforeach
                                        </select>
                                        @error('featured')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Save Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
