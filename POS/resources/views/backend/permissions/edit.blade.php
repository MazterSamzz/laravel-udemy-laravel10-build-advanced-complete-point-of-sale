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
                                action="{{ route('permissions.update', ['permission' => $permission->id]) }}">
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
                                                <option {{ $permission->group_name == 'employee' ? 'selected' : '' }}
                                                    value="employee">Employee
                                                </option>
                                                <option {{ $permission->group_name == 'customer' ? 'selected' : '' }}
                                                    value="customer">Customer
                                                </option>
                                                <option {{ $permission->group_name == 'supplier' ? 'selected' : '' }}
                                                    value="supplier">Supplier
                                                </option>
                                                <option {{ $permission->group_name == 'salary' ? 'selected' : '' }}
                                                    value="salary">Salary
                                                </option>
                                                <option {{ $permission->group_name == 'attendance' ? 'selected' : '' }}
                                                    value="attendance">
                                                    Attendance</option>
                                                <option {{ $permission->group_name == 'category' ? 'selected' : '' }}
                                                    value="category">Category
                                                </option>
                                                <option {{ $permission->group_name == 'product' ? 'selected' : '' }}
                                                    value="product">Product
                                                </option>
                                                <option {{ $permission->group_name == 'expense' ? 'selected' : '' }}
                                                    value="expense">Expense
                                                </option>
                                                <option {{ $permission->group_name == 'order' ? 'selected' : '' }}
                                                    value="order">Order
                                                </option>
                                                <option {{ $permission->group_name == 'stock' ? 'selected' : '' }}
                                                    value="stock">Stock
                                                </option>
                                                <option {{ $permission->group_name == 'role' ? 'selected' : '' }}
                                                    value="role">Role
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
