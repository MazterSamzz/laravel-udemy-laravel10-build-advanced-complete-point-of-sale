@extends('admin.dashboard')

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
                            <a href="{{ route('products.create') }}"
                                class="btn btn-primary rounded-pill waves-effect waves-light">Add Product</a>
                        </div>
                        <div class="page-title-right me-2">
                            <a href="{{ route('products.export') }}"
                                class="btn btn-primary rounded-pill waves-effect waves-light">Export Products</a>
                        </div>
                        <h4 class="page-title">All Products</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Product</h4>

                            <table id="basic-datatable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Store</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td> <img class="avatar-md img-thumbnail modal-trigger" alt="Product Image"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal{{ $key }}"
                                                    src="{{ asset($product->image ?: 'images/no_image.jpg') }}">
                                            </td>
                                            <td class="align-middle">{{ $product->name }}</td>
                                            <td class="align-middle">{{ $product->category_id }}</td>
                                            <td class="align-middle">{{ $product->supplier_id }}</td>
                                            <td class="align-middle">{{ $product->code }}</td>
                                            <td class="align-middle">
                                                {{ number_format($product->selling_price, 2, '.', ',') }}</td>
                                            <td class="align-middle">
                                                <div class="btn btn-warning rounded-pill waves-effect waves-light">
                                                    {{ $product->store }}</div>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-pencil"></span></a>
                                                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                                    class="btn btn-info rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-barcode"></span></a>
                                                <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-danger rounded-pill waves-effect waves-light delete-button"><span
                                                            class="mdi mdi-delete"></span></button>
                                                </form>
                                            </td>
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

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div>
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
