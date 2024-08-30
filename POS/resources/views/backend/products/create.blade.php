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
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Products</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Add Products</h5>

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Product Name" value="{{ old('name') }}" autofocus>
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Name -->

                                    <!-- Product Category -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Category</label>
                                            <select class="form-control"name="category_id">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Product Category -->

                                    <!-- Supplier -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Supplier</label>
                                            <select class="form-control"name="supplier_id">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Supplier -->

                                    <!-- Code -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Code</label>
                                            <input type="text" class="form-control" name="code"
                                                placeholder="Enter Product Code" value="{{ old('code') }}">
                                            @error('code')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Code -->

                                    <!-- Code -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Code</label>
                                            <input type="text" class="form-control" name="code"
                                                placeholder="Enter Product Code" value="{{ old('code') }}">
                                            @error('code')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Code -->

                                    <!-- Garage -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Product Garage</label>
                                            <input type="text" class="form-control" name="garage"
                                                placeholder="Enter Product Garage" value="{{ old('garage') }}">
                                            @error('garage')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Garage -->

                                    <!-- Buying Date -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Buying Date</label>
                                            <input type="text" class="form-control" name="buying_date"
                                                placeholder="Enter Product Buying Date" value="{{ old('buying_date') }}">
                                            @error('buying_date')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Buying Date -->

                                    <!-- Expire Date -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Expire Date</label>
                                            <input type="text" class="form-control" name="expire_date"
                                                placeholder="Enter Product Expire Date" value="{{ old('expire_date') }}">
                                            @error('expire_date')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Expire Date -->

                                    <!-- Buying Price -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Buying Price</label>
                                            <input type="text" class="form-control" name="buying_price"
                                                placeholder="Enter Product Buying Price" value="{{ old('buying_price') }}">
                                            @error('buying_price')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Buying Price -->

                                    <!-- Selling Price -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Selling Price</label>
                                            <input type="text" class="form-control" name="selling_price"
                                                placeholder="Enter Product Selling Price"
                                                value="{{ old('selling_price') }}">
                                            @error('selling_price')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Selling Price -->

                                    <!-- Product Image -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>
                                    </div><!-- End of Product Image -->

                                    <div class="col-md-12">
                                        <div class="mb3">
                                            <label for="image-preview" class="form-label"></label>
                                            <img src="{{ asset('images/no_image.jpg') }}" id ="image-preview"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="Product Image">
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
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

@section('js')
    <script src="{{ asset('backend/assets/js/imagePreview.js') }}"></script>
    <script type="text/javascript">
        imagePreview('#image', '#image-preview');
    </script>
@endsection
