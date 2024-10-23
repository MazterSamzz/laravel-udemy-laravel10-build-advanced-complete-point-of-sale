@extends('admin.layouts.admin_dashboard')

@section('css')
    <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
                                <li class="breadcrumb-item active">Add Role Permissions</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Role Permissions</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('role-has-permissions.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Add Role Permissions</h5>

                                <div class="row">

                                    <!-- Roles -->
                                    <div class="col-md-6 mb-3">
                                        <label for="role_id" class="form-label">Role Name</label>
                                        <select class="form-control" id="role_id" name="role_id" data-toggle="select2"
                                            data-width="100%">
                                            <option value="" selected disabled>---- Select Role Name ----
                                            </option>
                                            @foreach ($roles as $item)
                                                <option {{ old('role_id') ? 'selected' : '' }} value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div><!-- End of Roles -->

                                    <div class="form-check form-switch form-check-primary">
                                        <input class="form-check-input" type="checkbox" value="all" id="all">
                                        <label class="form-check-label text-capitalize" for="all">all
                                            check</label>
                                    </div>

                                    <div class="row">
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
                                                            id="{{ $permission->encryptedId }}">
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
    <script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/select2/js/select2.dark.js') }}"></script>

    <script>
        $(document).ready(function() {
            isSelect2('#role_id');
        });

        $('#all').click(function() {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        })
    </script>
@endsection
