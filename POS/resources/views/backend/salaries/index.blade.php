@extends('admin.dashboard')

@section('css')
    <!-- datatables css -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- datatables css end -->

    <!-- modal image css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/modal-image.css') }}">
@endsection

@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            @include('components.preloader')
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            {{-- <a href=""
                                class="btn btn-primary rounded-pill waves-effect waves-light">Add Salary</a> --}}
                        </div>
                        <h4 class="page-title">All Salaries</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{ date('F Y') }}</h4>


                            <table id="basic-datatable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Salary</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        <tr>
                                            <td scope="row" class="align-middle">
                                                {{ $key + 1 }}
                                            </td>
                                            <td> <img class="avatar-md img-thumbnail modal-img"
                                                    src="{{ asset($employee->photo) ?: asset('images/no_image.jpg') }}"
                                                    alt="Employee Photo" srcset=""></td>
                                            <td class="align-middle"> {{ $employee->name }}</td>
                                            <td class="align-middle">
                                                <span class="badge bg-info">{{ date('F', strtotime('-1 month')) }}</span>
                                            </td>
                                            <td class="align-middle" name="salary">{{ $employee->salary }}</td>
                                            <td class="align-middle" name="advance">
                                                @if ($employee->advance->amount == null)
                                                    <p>No Advance</p>
                                                @else
                                                    {{ $employee->advance->amount }}
                                                @endif
                                            </td>
                                            <td class="align-middle" name="due" style="color: #fff;">
                                                @php
                                                    $due = $employee->salary - $employee->advance->amount;
                                                @endphp
                                                <strong>{{ round($due) }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('salaries.pay.now', ['id' => $employee->id]) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light me-2">
                                                    Pay Now</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- Modal For Large Image -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImg" class="modal-img" src="" alt="Large Image">
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/sweetalert.js') }}"></script>
    <!-- datatables js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- datatables js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('backend/assets/js/numberSeparator.js') }}"></script>

    <script type="text/javascript">
        numberSeparatorDataTable('salary');
        numberSeparatorDataTable('advance');
        numberSeparatorDataTable('due');
    </script>

    <!-- Modal Image js-->
    <script src="{{ asset('backend/assets/js/modal-image.js') }}"></script>
@endsection
