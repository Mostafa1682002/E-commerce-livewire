@extends('layouts.master', ['title' => 'New Coupones'])
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
                        <li class="breadcrumb-item active" aria-current="page">Coupones</li>
                        <li class="breadcrumb-item active" aria-current="page">New Coupone</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="row">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">New Coupone</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('admin.coupones.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputCode" class="form-label">Code</label>
                            <input type="text" name="code" value="{{ old('code') }}" class="form-control"
                                id="inputCode">
                            @error('code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputTeacher" class="form-label">Type</label>
                            <select id="inputTeacher" class="form-select" name="type" required>
                                <option selected="" disabled>Choose...</option>
                                <option @selected(old('type') == 'fixed') value="fixed">Fixed</option>
                                <option @selected(old('type') == 'percent') value="percent">Percent</option>
                            </select>
                            @error('type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputValue" class="form-label">Value</label>
                            <input type="number" step="any" name="value" value="{{ old('value') }}"
                                class="form-control" id="inputValue">
                            @error('value')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputCartValue" class="form-label">Cart Value</label>
                            <input type="number" step="any" name="cart_value" value="{{ old('cart_value') }}"
                                class="form-control" id="inputCartValue">
                            @error('cart_value')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Expiry Date</label>
                            <input type='text' id="datepicker" class="form-control" name="expiry_date" />
                            @error('expiry_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap5'
            // dateFormat: 'yy-mm-dd'
        });
    </script>
@endpush
