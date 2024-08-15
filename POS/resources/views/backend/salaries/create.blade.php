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
                                <li class="breadcrumb-item active">Add Salary</li>
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
                                    Add Salary</h5>

                                <div class="row">

                                    <!-- Employee Id -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employee_id" class="form-label">Employee</label>
                                            <select class="form-select" id="employee_id" name="employee_id">
                                                <option value="" selected disabled>-- Select Employee --</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}" data-salary={{ $employee->salary }}>
                                                        {{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Employee Id -->

                                    <!-- Month -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">Month</label>
                                            <select class="form-select" id="month" name="month">
                                                <option value="" selected disabled>-- Select Month --</option>
                                                <option value=1 {{ now()->month == 1 ? 'selected' : '' }}>
                                                    January</option>
                                                <option value=2 {{ now()->month == 2 ? 'selected' : '' }}>
                                                    February</option>
                                                <option value=3 {{ now()->month == 3 ? 'selected' : '' }}>
                                                    March</option>
                                                <option value=4 {{ now()->month == 4 ? 'selected' : '' }}>
                                                    April</option>
                                                <option value=5 {{ now()->month == 5 ? 'selected' : '' }}>
                                                    May</option>
                                                <option value=6 {{ now()->month == 6 ? 'selected' : '' }}>
                                                    June</option>
                                                <option value=7 {{ now()->month == 7 ? 'selected' : '' }}>
                                                    July</option>
                                                <option value=8 {{ now()->month == 8 ? 'selected' : '' }}>
                                                    August</option>
                                                <option value=9 {{ now()->month == 9 ? 'selected' : '' }}>
                                                    September</option>
                                                <option value=10 {{ now()->month == 10 ? 'selected' : '' }}>
                                                    October</option>
                                                <option value=11 {{ now()->month == 11 ? 'selected' : '' }}>
                                                    November</option>
                                                <option value=12 {{ now()->month == 12 ? 'selected' : '' }}>
                                                    December</option>
                                            </select>
                                            @error('month')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Month -->

                                    <!-- Year -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year</label>
                                            <select class="form-select" id="year" name="year">
                                                <option value="" selected disabled>-- Select Year --</option>
                                                @for ($i = 2000; $i < 2300; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ now()->year == $i ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('year')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Year -->

                                    <!-- Amount -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount"
                                                placeholder="Enter amount" value="">
                                            @error('amount')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> <!-- End of Amount -->
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

    <script src="{{ asset('backend/assets/js/numberSeparator.js') }}"></script>

    <script type="text/javascript">
        document.getElementById('employee_id').addEventListener('change', function() {
            var selectedEmployee = this.options[this.selectedIndex];
            var salary = selectedEmployee.getAttribute('data-salary');
            document.getElementById('amount').value = salary ||
                ''; // Mengisi input amount dengan salary atau kosongkan jika tidak ada
            numberSeparatorById('amount');
        });
    </script>
@endsection
