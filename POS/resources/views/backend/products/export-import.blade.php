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
                                <a href="{{ route('products.export') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Download
                                    Products</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Import Products</h4>
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

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Import Product</label>
                                            <input type="file" class="form-control" name="import_file"
                                                placeholder="Enter Product Name" value="{{ old('name') }}" autofocus>
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Name -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Upload</button>
                                    </div>
                            </form>
                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
