@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Profile Page</h4>

                            <form action="">
                                <div class="row mb-3">
                                    <label  for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input id="name" name="name" class="form-control" type="text" placeholder="Name" value="{{ $editData->name }}" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input id="email" name="email" class="form-control" type="text" placeholder="Email" value="{{ $editData->email }}" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input id="username" name="username" class="form-control" type="text" placeholder="Username" value="{{ $editData->username }}" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input id="profile_image" name="profile_image" class="form-control" type="file" placeholder="Username" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Card image cap">
                                    </div>
                                </div> <!-- end row -->
                                <input type="submit" value="Update Profile" class="btn btn-info btn-round">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection