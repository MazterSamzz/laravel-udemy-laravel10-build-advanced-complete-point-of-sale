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
                                <li class="breadcrumb-item active">Show Suppliers</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Suppliers</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                Edit Suppliers</h5>

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <p class="text-danger">{{ $supplier->name }}</p>
                                    </div>
                                </div><!-- End of Name -->

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <p class="text-danger">{{ $supplier->email }}</p>
                                    </div>
                                </div><!-- End of Email -->

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <p class="text-danger">{{ $supplier->phone }}</p>
                                    </div>
                                </div> <!-- End of Phone -->

                                <!-- Addresses -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <p class="text-danger">{{ $supplier->address }}</p>
                                    </div>
                                </div> <!-- End of Adresses -->

                                <!-- Shopname -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="shopname" class="form-label">shopname</label>
                                        <p class="text-danger">{{ $supplier->shopname }}</p>
                                    </div>
                                </div> <!-- End of Shopname -->

                                <!-- Type -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <p class="text-danger">{{ $supplier->type }}</p>
                                    </div>
                                </div> <!-- End of Type -->

                                <!-- Account Holder -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="account_holder" class="form-label">Account Holder</label>
                                        <p class="text-danger">{{ $supplier->account_holder }}</p>
                                    </div>
                                </div> <!-- End of Account Holder -->

                                <!-- Account Number -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="account_number" class="form-label">Account Number</label>
                                        <p class="text-danger">{{ $supplier->accout_number }}</p>
                                    </div>
                                </div> <!-- End of Account Number -->

                                <!-- Bank Name -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                        <p class="text-danger">{{ $supplier->bank_name }}</p>
                                    </div>
                                </div> <!-- End of Bank Name -->

                                <!-- Bank Branch -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bank_branch" class="form-label">Bank Branch</label>
                                        <p class="text-danger">{{ $supplier->bank_branch }}</p>
                                    </div>
                                </div> <!-- End of Bank Branch -->

                                <!-- City -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <p class="text-danger">{{ $supplier->city }}</p>
                                    </div>
                                </div> <!-- End of City -->


                                <!-- Photo -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                    </div>
                                    <img id="photo-preview"
                                        src="@isset($supplier->photo)
                                                    {{ asset($supplier->photo) }}
                                                @else
                                                    {{ asset('images/no_image.jpg') }}
                                                @endisset
                                                "
                                        class="rounded-circle avatar-lg img-thumbnail">
                                </div><!-- End of Photo -->
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
    <script src="{{ asset('backend/assets/js/imagePreview.js') }}"></script>
    <script type="text/javascript">
        imagePreview('#photo', '#photo-preview');
    </script>
@endsection
