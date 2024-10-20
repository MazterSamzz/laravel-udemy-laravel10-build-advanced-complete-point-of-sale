@extends('admin.layouts.admin_dashboard')

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
                                <li class="breadcrumb-item active"><a href="{{ route('products.index') }}"
                                        class="btn btn-primary rounded-pill waves-effect waves-light">Back</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Barcode Products</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="myForm" method ="post" action="{{ route('products.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Barcode Products</h5>

                                <div class="row">
                                    <!-- Code -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Product Code</label>
                                            <h3>{{ $product->code }}</h3>
                                        </div>
                                    </div><!-- End of Code -->
                                    <!-- Barcode -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Product Barcode</label>
                                            <h3>{!! $barcode !!}</h3>
                                        </div>
                                    </div><!-- End of Barcode -->

                            </form>
                        </div>
                        <button class="btn btn-info rounded-pill waves-effect waves-light"><a
                                href="{{ route('products.print.barcode', ['product' => $product->id]) }}">Print Barcode</a>
                        </button>
                        <button class="btn btn-warning rounded-pill waves-effect waves-light"><a
                                href="{{ route('products.print.qrcode', ['product' => $product->id]) }}">Print QR Code</a>
                        </button>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
