@extends('admin.layouts.admin_dashboard')

@section('css')
    <!-- datatables css -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- datatables css end -->

    <!-- modal image css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/modal-image.css') }}">
@endsection

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">POS</li>
                            </ol>
                        </div>
                        <h4 class="page-title">POS</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Act</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($carts as $item)
                                            <tr class="text-align-center">
                                                <th scope="row" class="align-middle">{{ $item->name }}</th>
                                                <td>
                                                    <form
                                                        action="{{ route('sales.update-cart', ['rowId' => $item->rowId]) }}"
                                                        method="post" class="d-flex">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="number" name="qty" value="{{ $item->qty }}"
                                                            min="1" style="width: 40px">
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="align-middle">{{ number_format($item->price) }}</td>
                                                <td class="align-middle">{{ number_format($item->subtotal) }}</td>
                                                <td class="align-middle">
                                                    <form method="post"
                                                        action="{{ route('sales.delete-cart', ['rowId' => $item->rowId]) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-primary fs-4 text-white">
                                <p>Quantity: {{ $display['qty'] }}</p>
                                <p>Sub Total: {{ $display['subtotal'] }}</p>
                                <p>Vat: {{ $display['tax'] }}</p>
                                <h2 class="text-white">Total: </h2>
                                <h1 class="text-white">{{ $display['total'] }}</h1>
                            </div>
                            <form action="{{ route('customers.create') }}" class="mt-3">
                                <div class="form-group mb-3">
                                    <div class="mb-2">
                                        <label for="customer_id" class="form-label"> Customer</label>
                                        <a class="btn btn-primary rounded-pill waves-effect waves-light"
                                            href="{{ route('customers.create') }}">Add Customer</a>
                                    </div>
                                    <select name="customer_id" class="form-select">
                                        <option selected disabled> Select Customer </option>
                                        @foreach ($customers as $item)
                                            <option {{ old('customer_id') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary rounded-pill waves-effect waves-light" type="submit">Create
                                    Invoice</button>
                            </form>
                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                Personal Info</h5>
                            <div class="row">
                                <table id="basic-datatable" class="table dt-responsive table-hover nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td scope="row">{{ $key + 1 }}</td>
                                                <td> <img class="avatar-md img-thumbnail modal-trigger" alt="Product Image"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#imageModal{{ $key }}"
                                                        src="{{ asset($product->image ?: 'images/no_image.jpg') }}">
                                                </td>
                                                <td class="align-middle">{{ $product->name }}</td>
                                                <form method="post"
                                                    action="{{ route('sales.add-cart', ['product' => $product->id]) }}">
                                                    @csrf
                                                    @method('post')
                                                    <td class="align-middle">
                                                        <button type="submit" class="fs-5 text-light">
                                                            <i class="fas fa-plus-square"></i>
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>

                                            <!-- Modal for Large Image -->
                                            <div class="modal fade" id="imageModal{{ $key }}" tabindex="-1"
                                                aria-labelledby="imageModalLabel{{ $key }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <button type="button"
                                                                class="btn-close position-absolute top-0 end-0 m-2"
                                                                data-bs-dismiss="modal"aria-label="Close"></button>
                                                            <img class="img-fluid"
                                                                src="{{ asset($product->image ?: 'images/no_image.jpg') }}"
                                                                alt="Large Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- End Modal for Large Image -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/sweetalert.js') }}"></script>
    <!-- datatables js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- datatables js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
@endsection
