@extends('admin.dashboard')

@section('css')
    <!-- datatables css -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- datatables css end -->

    <!-- modal image css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/modal-image.css') }}">
@endsection

@section('admin')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
                        <li class="breadcrumb-item active">Sales Detail</li>
                    </ol>
                </div>
                <h4 class="page-title">Sales Detail</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <!-- Track Order -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Track Order</h4>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h5 class="mt-0">Order ID:</h5>
                                <p>#VL2537</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h5 class="mt-0">Tracking ID:</h5>
                                <p>894152012012</p>
                            </div>
                        </div>
                    </div>

                    <div class="track-order-list">
                        <ul class="list-unstyled">
                            <li class="completed">
                                <h5 class="mt-0 mb-1">Order Placed</h5>
                                <p class="text-muted">April 21 2019 <small class="text-muted">07:22 AM</small> </p>
                            </li>
                            <li class="completed">
                                <h5 class="mt-0 mb-1">Packed</h5>
                                <p class="text-muted">April 22 2019 <small class="text-muted">12:16 AM</small></p>
                            </li>
                            <li>
                                <span class="active-dot dot"></span>
                                <h5 class="mt-0 mb-1">Shipped</h5>
                                <p class="text-muted">April 22 2019 <small class="text-muted">05:16 PM</small></p>
                            </li>
                            <li>
                                <h5 class="mt-0 mb-1"> Delivered</h5>
                                <p class="text-muted">Estimated delivery within 3 days</p>
                            </li>
                        </ul>

                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-primary">Show Details</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Sales Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="row d-flex mb-2">
                            <div class="col-md-6">
                                <h4>Sales Details</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <form method="post" action="{{ route('sales.complete', ['sale' => $sale->id]) }}">
                                    @csrf
                                    @method('patch')
                                    <button type="submit"
                                        class="btn btn-sm btn-primary rounded-pill waves-effect waves-light">
                                        <i class="fas fa-check-circle me-1"></i>Complete Order</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-centered mb-0">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Product name</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($salesDetails as $key => $value)
                                    <tr class="align-middle text-end">
                                        <th scope="row" class="align-middle text-start">{{ $value->product->name }}</th>
                                        <td class="text-center"> <img class="avatar-md img-thumbnail modal-trigger"
                                                alt="Product Image" data-bs-toggle="modal"
                                                data-bs-target="#imageModal{{ $key }}"
                                                src="{{ asset($value->product->image ?: 'images/no_image.jpg') }}">
                                        </td>
                                        <td>{{ $value->qty }}</td>
                                        <td>
                                            {{ number_format($value->price, 2, '.', ',') }}
                                        </td>
                                        <td>
                                            {{ number_format($value->total_price, 2, '.', ',') }}
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
                                                        src="{{ asset($value->product->image ?: 'images/no_image.jpg') }}"
                                                        alt="Large Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End Modal for Large Image -->
                                @endforeach
                                <tr>

                                </tr>
                                <tr class="text-end">
                                    <th scope="row" colspan="4">Sub Total :</th>
                                    <td>
                                        <div class="fw-bold">{{ number_format($sale->total_products, 2, '.', ',') }}</div>
                                    </td>
                                </tr>
                                <tr class="text-end">
                                    <th scope="row" colspan="4">Estimated Tax :</th>
                                    <td>{{ number_format($sale->vat, 2, '.', ',') }}</td>
                                </tr>
                                <tr class="text-end">
                                    <th scope="row" colspan="4">Total :</th>
                                    <td>
                                        <div class="fw-bold">{{ number_format($sale->total, 2, '.', ',') }}</div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========================================= --}}
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
