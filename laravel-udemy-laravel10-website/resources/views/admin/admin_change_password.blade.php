@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change Password Page</h4><br><br>

                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                                @endforeach
                            @endif

                            <form method="post" action="{{ route('update.password') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label  for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input id="oldpassword" name="oldpassword" class="form-control" type="password" placeholder="Old Password" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label  for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input id="newpassword" name="newpassword" class="form-control" type="password" placeholder="New Password" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label  for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input id="confirm_password" name="confirm_password" class="form-control" type="password" placeholder="Confirm Password" />
                                    </div>
                                </div> <!-- end row -->
                                <input type="submit" value="Change Password" class="btn btn-info btn-round">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection