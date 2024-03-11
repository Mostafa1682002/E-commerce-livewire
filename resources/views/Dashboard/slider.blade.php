@extends('layouts.master', ['title' => 'Home Slider'])
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
                        <li class="breadcrumb-item active" aria-current="page">Home Slider</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">

                @can('slider-create')
                    <div class="col-6 col-md-4">
                        {{-- =====================Add================= --}}
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> Add New Slider
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Slider</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="POST" action="{{ route('admin.slider.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Top Title</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="top_title"
                                                    required placeholder="Enter Top Title" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label"> Title</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="title"
                                                    required placeholder="Enter Title" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Sub Title</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="sub_title"
                                                    required placeholder="Enter Sub Title" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Offer</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="offer"
                                                    required placeholder="Enter Offer" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Image</label>
                                                <input name="image" type="file" class="dropify" data-height="100"
                                                    accept=".jpg, .png, image/jpeg, image/png" />
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan




                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tot Title</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->top_title }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->sub_title }}</td>
                                    <td>
                                        <span class="badge {{ $row->status->badge() }}">{{ $row->status->slider() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ $row->image }}" title="Show Image" target="_blank"><img
                                                src="{{ $row->image }}" style="width: 50px;height:50px;"
                                                alt=""></a>
                                    </td>
                                    <td>
                                        @can('slider-delete')
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Slider</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" method="POST"
                                                                action="{{ route('admin.slider.destroy', $row->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <p>Are You Sure Delete Slider ??</p>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2"
                                                                        class="form-label">Title</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="title" readonly
                                                                        value="{{ $row->title }}">
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
                                        @endcan

                                        @can('slider-edit')
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
                                                                Slider</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" method="POST"
                                                                action="{{ route('admin.slider.update', $row->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">Top
                                                                        Title</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="top_title" required
                                                                        placeholder="Enter Top Title"
                                                                        value="{{ $row->top_title }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">
                                                                        Title</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="title" required
                                                                        placeholder="Enter Title"
                                                                        value="{{ $row->title }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">Sub
                                                                        Title</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="sub_title" required
                                                                        placeholder="Enter Sub Title"
                                                                        value="{{ $row->sub_title }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2"
                                                                        class="form-label">Offer</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="offer" required
                                                                        placeholder="Enter Offer"
                                                                        value="{{ $row->offer }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2"
                                                                        class="form-label">Status</label>
                                                                    <select name="status" id=""
                                                                        class="form-select">
                                                                        <option @selected($row->status->slider() == 'Disactive') value="0">
                                                                            DisActive</option>
                                                                        <option @selected($row->status->slider() == 'Active') value="1">
                                                                            Active</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">Update
                                                                        Image</label>
                                                                    <input name="image" type="file" class="dropify"
                                                                        data-height="100"
                                                                        accept=".jpg, .png, image/jpeg, image/png" />
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
                                        @endcan

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
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
