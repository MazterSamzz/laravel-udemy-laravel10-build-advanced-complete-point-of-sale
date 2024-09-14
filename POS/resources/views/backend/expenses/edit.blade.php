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
                                <li class="breadcrumb-item active">Edit Expense</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Expenses</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post"
                                action="{{ route('expenses.update', ['expense' => $expense->id, 'filter' => $filter]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Edit Expenses</h5>

                                <div class="row">
                                    <!-- Details -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="details" class="form-label">Details</label>
                                            <textarea class="form-control" name="details" autofocus>{{ $expense->details ?? old('details') }}</textarea>
                                            @error('details')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Details -->

                                    <!-- Amount -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="text" class="form-control amount" id="amount" name="amount"
                                                placeholder="Enter Amount" value="{{ $expense->amount ?? old('amount') }}">
                                            @error('amount')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!-- End of Email -->

                                    <!-- Date -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Date</label>
                                            <input class="form-control" type="date" name="date"
                                                value="{{ $expense->date ?? old('date') }}">
                                        </div>
                                    </div><!-- End of Date -->

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
    <script src="{{ asset('backend/assets/js/numberSeparator.js') }}"></script>

    <script type="text/javascript">
        numberSeparatorByName('amount');
    </script>
@endsection
