@extends('layouts.master', ['title' => 'Edit Admins'])
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
                        <li class="breadcrumb-item active" aria-current="page">Admins</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
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
                        <h5 class="mb-0 text-primary">Edit Admin</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="name" name="name" value="{{ $admin->name }}" class="form-control" required
                                id="inputName">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $admin->email }}" class="form-control" required
                                id="inputEmail">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Roles</label>
                            <select class="multiple-select" name="roles[]" data-placeholder="Choose anything"
                                multiple="multiple">
                                @foreach ($roles as $role)
                                    <option @selected(in_array($role, $adminRole)) value="{{ $role }}">{{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" name="password" value="" class="form-control" id="inputPassword">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputPC" class="form-label">Confirmed Password</label>
                            <input type="password" name="password_confirmation" value="" class="form-control"
                                id="inputPC">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endpush
