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
                                <li class="breadcrumb-item active">Edit Role</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Roles</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('roles.update', $role->encrypted_id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Edit Roles</h5>

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Name" value="{{ $role->name }}" disabled>
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Name -->
                                </div> <!-- end row -->

                                <div class="row">

                                    <div class="form-check form-switch form-check-primary">
                                        <input class="form-check-input" type="checkbox" value="all" id="all">
                                        <label class="form-check-label text-capitalize" for="all">all
                                            check</label>
                                    </div>

                                    @foreach ($permissionGroups as $group => $permissions)
                                        @if ($loop->iteration % 2 == 1)
                                            <div class="border-top my-2 w-100"></div>
                                        @endif

                                        <div class="col-12 col-sm-6 col-md-2">
                                            <div class="form-check form-switch mb-2 form-check-success">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="{{ $group }}">
                                                <label class="form-check-label text-capitalize"
                                                    for="{{ $group }}">{{ $group }}</label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check form-switch form-check-primary">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->encryptedId }}"
                                                        id="{{ $permission->encryptedId }}"
                                                        {{ dd([$permission->encrypted_id, $encryptedIds]) }}
                                                        @if (in_array($permission->encrypted_id, $encryptedIds)) checked @endif>
                                                    <label class="form-check-label text-capitalize"
                                                        for="{{ $permission->encryptedId }}">
                                                        {{ str_replace('.', ' ', $permission->name) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
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
