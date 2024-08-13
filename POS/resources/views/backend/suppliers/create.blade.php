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
                                <li class="breadcrumb-item active">Add Employe</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Customers</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('customers.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Add Customers</h5>

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Name" value="{{ old('name') }}" autocomplete="name"
                                                autofocus>
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Name -->

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter email" value="{{ old('email') }}"
                                                autocomplete="email }}" autocomplete="email">
                                            @error('email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Email -->

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                placeholder="Enter Phone" value="{{ old('phone') }}" autocomplete="phone">
                                            @error('phone')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Phone -->

                                    <!-- Addresses -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Enter Address" value="{{ old('address') }}"
                                                autocomplete="address">
                                            @error('address')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Adresses -->

                                    <!-- Shopname -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="shopname" class="form-label">shopname</label>
                                            <input type="text" class="form-control" id="shopname" name="shopname"
                                                placeholder="Enter Shop Name" value="{{ old('shopname') }}"
                                                autocomplete="shopname">
                                            @error('shopname')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Shopname -->

                                    <!-- Account Holder -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_holder" class="form-label">Account Holder</label>
                                            <input type="text" class="form-control" id="account_holder"
                                                name="account_holder" placeholder="Enter Account Holder"
                                                value="{{ old('account_holder') }}">
                                            @error('account_holder')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Account Holder -->

                                    <!-- Account Number -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" class="form-control" id="account_number"
                                                name="account_number" placeholder="Enter Account Number"
                                                value="{{ old('account_number') }}">
                                            @error('account_number')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Account Number -->

                                    <!-- Bank Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                placeholder="Enter Bank Name" value="{{ old('bank_name') }}">
                                            @error('bank_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Bank Name -->

                                    <!-- Bank Branch -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank_branch" class="form-label">Bank Branch</label>
                                            <input type="text" class="form-control" id="bank_branch"
                                                name="bank_branch" placeholder="Enter Bank Branch"
                                                value="{{ old('bank_branch') }}">
                                            @error('bank_branch')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Bank Branch -->

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="Enter City" value="{{ old('city') }}"
                                                autocomplete="city">
                                            @error('city')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of City -->


                                    <!-- Photo -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" id="photo" name="photo" class="form-control">
                                            @error('photo')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <img id="photo-preview" src="{{ asset('images/no_image.jpg') }}"
                                            class="rounded-circle avatar-lg img-thumbnail">
                                    </div><!-- End of Photo -->
                                </div> <!-- end row -->

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
        imagePreview('#photo', '#photo-preview');
    </script>
@endsection
