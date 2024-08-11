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

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('employees.create') }}"
                                class="btn btn-primary rounded-pill waves-effect waves-light">Add Employee</a>
                        </div>
                        <h4 class="page-title">Datatables</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Employee</h4>

                            <table id="basic-datatable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        @php
                                            $photo = $employee->photo ?: 'images/no_image.jpg';
                                        @endphp
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td> <img class="avatar-md img-thumbnail modal-img"
                                                    data-large="{{ asset($photo) }}" src="{{ asset($photo) }}"
                                                    alt="Photo-Picture">
                                            </td>
                                            <td class="align-middle">{{ $employee->email }}</td>
                                            <td class="align-middle">{{ $employee->phone }}</td>
                                            <td class="align-middle" name="salary">{{ $employee->salary }}</td>
                                            <td>
                                                <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-pencil"></span></a>
                                                <a href="{{--  --}}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"><span
                                                        class="mdi mdi-delete"></span></a>
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
    <!-- datatables js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
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

    <!-- Modal Image js-->
    <script src="{{ asset('backend/assets/js/modal-image.js') }}"></script>
@endsection
