@extends('layouts.master', ['title' => 'Coupones'])
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
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="col-6 col-md-4">
                    {{-- =====================Add================= --}}
                    <a href="{{ route('admin.coupones.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add
                        New Coupone</a>
                    <!-- Modal -->

                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Cart_value</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->code }}</td>
                                    <td>{{ $row->type }}</td>
                                    <td>{{ $row->value }}</td>
                                    <td>{{ $row->cart_value }}</td>
                                    <td>{{ $row->expiry_date }}</td>
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Coupone</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3" method="POST"
                                                            action="{{ route('admin.coupones.destroy', $row->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <p>Are You Sure Delete Coupone ??</p>
                                                            <div class="col-12">
                                                                <label for="inputAddress2" class="form-label">Code</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputAddress2" name="code" readonly
                                                                    value="{{ $row->code }}">
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
                                        <a href="{{ route('admin.coupones.edit', $row->id) }}"
                                            class="btn btn-success btn-sm">Update</a>
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
