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
                                <a href="{{ route('products.import.sample') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Download
                                    Sample Import Products</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Import Products</h4>
                    </div>
                </div>
            </div> <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="myForm" method="post" action="{{ route('products.import') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Import -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Import Product</label>
                                            <input type="file" class="form-control" name="import" autofocus>
                                            @error('import')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Import -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                            <i class="mdi mdi-content-save"></i> Upload
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div><!-- end row-->
        </div> <!-- container -->

    </div> <!-- content -->
@endsection
