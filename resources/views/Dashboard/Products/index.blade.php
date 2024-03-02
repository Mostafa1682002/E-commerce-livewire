@extends('layouts.master', ['title' => 'Products'])
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
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="col-6 col-md-4">
                    {{-- =====================Add================= --}}
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add
                        New Product</a>
                    <!-- Modal -->

                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Featured</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>{{ $row->regular_price }}</td>
                                    <td>
                                        <img src="{{ $row->main_image_1 }}" style="width: 50px;height:50px" alt=""
                                            srcset="">
                                    </td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $row->featured->badge() }}">{{ $row->featured->featured() }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $row->status->badge() }}">{{ $row->status->product() }}</span>
                                    </td>

                                    <td>
                                        {{-- =============Delate Request========================= --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{ $loop->index }}">Delete
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3" method="POST"
                                                            action="{{ route('admin.products.destroy', $row->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <p>Are You Sure Delete Product ??</p>
                                                            <div class="col-12">
                                                                <label for="inputAddress2" class="form-label">Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputAddress2" name="name" readonly
                                                                    value="{{ $row->name }}">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- =============Upadate========================= --}}
                                        <a href="{{ route('admin.products.edit', $row->id) }}"
                                            class="btn btn-success btn-sm">Update</a>

                                        <a href="{{ route('admin.products.show', $row->id) }}"
                                            class="btn btn-warning btn-sm text-white">
                                            Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });

        });
    </script>
@endpush
