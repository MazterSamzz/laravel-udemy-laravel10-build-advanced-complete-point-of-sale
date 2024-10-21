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
                                <li class="breadcrumb-item active">Edit Permission</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Permissions</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post"
                                action="{{ route('permissions.update', ['permission' => $permission->encrypted_id]) }}">
                                @csrf
                                @method('patch')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Edit Permissions</h5>

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Name" value="{{ $permission->name }}" autocomplete="name"
                                                autofocus>
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Name -->

                                    <!-- Group -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="group_name" class="form-label">Group Name</label>
                                            <select class="form-control" id="group_name" name="group_name"
                                                data-toggle="select2" data-width="100%">
                                                <option value="" selected disabled>---- Select Group Name ----
                                                </option>
                                                <option {{ $permission->group_name == 'pos' ? 'selected' : '' }}
                                                    value="pos">POS
                                                </option>
                                                <option {{ $permission->group_name == 'employees' ? 'selected' : '' }}
                                                    value="employees">Employees
                                                </option>
                                                <option {{ $permission->group_name == 'customers' ? 'selected' : '' }}
                                                    value="customers">Customers
                                                </option>
                                                <option {{ $permission->group_name == 'suppliers' ? 'selected' : '' }}
                                                    value="suppliers">Suppliers
                                                </option>
                                                <option {{ $permission->group_name == 'salaries' ? 'selected' : '' }}
                                                    value="salaries">Salaries
                                                </option>
                                                <option {{ $permission->group_name == 'attendances' ? 'selected' : '' }}
                                                    value="attendances">
                                                    Attendance</option>
                                                <option {{ $permission->group_name == 'categories' ? 'selected' : '' }}
                                                    value="categories">Categories
                                                </option>
                                                <option {{ $permission->group_name == 'products' ? 'selected' : '' }}
                                                    value="products">Products
                                                </option>
                                                <option {{ $permission->group_name == 'expenses' ? 'selected' : '' }}
                                                    value="expenses">Expenses
                                                </option>
                                                <option {{ $permission->group_name == 'sales' ? 'selected' : '' }}
                                                    value="sales">Sales
                                                </option>
                                                <option {{ $permission->group_name == 'stocks' ? 'selected' : '' }}
                                                    value="stocks">Stocks
                                                </option>
                                                <option {{ $permission->group_name == 'roles' ? 'selected' : '' }}
                                                    value="roles">Roles
                                                </option>
                                            </select>
                                            @error('group_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Group -->
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
