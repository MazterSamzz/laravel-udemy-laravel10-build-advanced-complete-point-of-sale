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
                                <li class="breadcrumb-item active">Pay Salary</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Salary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('salaries.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Pay Salary</h5>

                                <div class="row">

                                    <!-- Employee Id -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Employee</label>
                                            <strong style="color: white;" name="name">{{ $employee->name }}</strong>
                                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                        </div>
                                    </div> <!-- End of Employee Id -->

                                    <!-- Year -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year</label>
                                            <strong style="color: white;">{{ date('Y') }}</strong>
                                            <input type="hidden" name="year" value="{{ date('Y') }}">
                                        </div>
                                    </div> <!-- End of Year -->

                                    <!-- Month -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">Month</label>
                                            <strong style="color: white;">{{ date('F', strtotime('-1 month')) }}</strong>
                                            <input type="hidden" name="month" value="{{ now()->subMonth()->month }}">
                                        </div>
                                    </div> <!-- End of Month -->

                                    <!-- Salary -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salary</label>
                                            <strong style="color: white;" name="salary_v">{{ $employee->salary }}</strong>
                                            <input type="hidden" name="paid" value="{{ $employee->salary }}">
                                        </div>
                                    </div> <!-- End of Salary -->

                                    <!-- Advance Salary -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="advance" class="form-label">Advance Salary</label>
                                            <strong style="color: white;"
                                                name="advance_v">{{ $employee->advance->amount }}</strong>
                                            <input type="hidden" name="advance" value="{{ $employee->advance->amount }}">
                                        </div>
                                    </div> <!-- End of Advance Salary -->

                                    <!-- Due Salary -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="due" class="form-label">Due Salary</label>
                                            <strong style="color: white;"
                                                name="due_v">{{ $employee->salary - $employee->advance->amount }}</strong>
                                            <input type="hidden" name="due"
                                                value="{{ $employee->salary - $employee->advance->amount }}">
                                        </div>
                                    </div> <!-- End of Due Salary -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Paid Salary</button>
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

    <script src="{{ asset('backend/assets/js/numberSeparator.js') }}"></script>

    <script type="text/javascript">
        numberSeparatorDataTable('salary_v');
        numberSeparatorDataTable('advance_v');
        numberSeparatorDataTable('due_v');
    </script>
@endsection
