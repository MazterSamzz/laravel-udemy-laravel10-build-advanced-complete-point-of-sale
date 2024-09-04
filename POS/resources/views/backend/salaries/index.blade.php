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
                            <a href="{{ route('advance-salaries.create') }}"
                                class="btn btn-primary rounded-pill waves-effect waves-light">Add salary</a>
                        </div>
                        <h4 class="page-title">All Advance Salaries</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Paid Salary</h4>

                            <table id="basic-datatable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($salaries as $key => $salary)
                                        <tr>
                                            <td scope="row" class="align-middle">
                                                {{ $salary->year . '/' . ($salary->month < 10 ? '0' . $salary->month : $salary->month) }}
                                            </td>
                                            <td> <img class="avatar-md img-thumbnail modal-trigger" alt="Employee Photo"
                                                    data-bs-toggle="modal" data-bs-target="#photoModal{{ $key }}"
                                                    src="{{ asset($salary->employee->photo ?: 'images/no_image.jpg') }}">
                                            </td>
                                            <td class="align-middle"> {{ $salary->employee->name }}</td>
                                            <td class="align-middle text-end" name="salary">{{ $salary->paid }}</td>
                                            <td class="align-middle"><span class="badge bg-success"> Full Paid</span></td>
                                            <td class="align-middle">
                                                <a href="#"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light me-2">History</a>
                                            </td>
                                        </tr>

                                        <!-- Modal for Large Photo -->
                                        <div class="modal fade" id="photoModal{{ $key }}" tabindex="-1"
                                            aria-labelledby="photoModalLabel{{ $key }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <button type="button"
                                                            class="btn-close position-absolute top-0 end-0 m-2"
                                                            data-bs-dismiss="modal"aria-label="Close"></button>
                                                        <img class="img-fluid"
                                                            src="{{ asset($salary->employee->photo ?: 'images/no_image.jpg') }}"
                                                            alt="Large Photo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- End Modal for Large Photo -->
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->
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
        </script>
    @endsection
