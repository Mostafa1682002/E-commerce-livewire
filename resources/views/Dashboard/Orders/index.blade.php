@extends('layouts.master', ['title' => 'Orders'])
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
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>#ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->user->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ $row->total }}</td>
                                    <td>
                                        <span class="badge {{ $row->status->badge() }}">{{ $row->status->order() }}</span>
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
                                                            action="{{ route('admin.orders.destroy', $row->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <p>Are You Sure Delete Order ??</p>
                                                            <div class="col-12">
                                                                <label for="inputAddress2" class="form-label">ID</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputAddress2" name="id" readonly
                                                                    value="{{ $row->id }}">
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
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $loop->index }}">Update
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update
                                                            Status User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3" method="POST"
                                                            action="{{ route('admin.orders.update', $row->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-12">
                                                                <label for="inputAddress2" class="form-label">ID</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputAddress2" name="id" required
                                                                    value="{{ $row->id }}" readonly>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputAddress2" class="form-label">Status</label>
                                                                <select name="status" id="" class="form-select">
                                                                    @foreach (collect(\App\enums\StatusOrder::cases())->toArray() as $status)
                                                                        <option @selected($status == $row->status)
                                                                            value="{{ $status }}">
                                                                            {{ $status->order() }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.orders.show', $row->id) }}"
                                            class="btn btn-warning btn-sm">
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
