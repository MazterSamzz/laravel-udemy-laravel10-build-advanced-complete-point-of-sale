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
                            <a href="{{ route('salaries.create') }}"
                                class="btn btn-primary rounded-pill waves-effect waves-light">Add Salary</a>
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
                            <h4 class="header-title">Salary</h4>


                            <table id="basic-datatable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($salaries as $salary)
                                        <tr>
                                            <td scope="row" class="align-middle">
                                                {{ $salary->year . '/' . ($salary->month < 10 ? '0' . $salary->month : $salary->month) }}
                                            </td>
                                            <td> <img class="avatar-md img-thumbnail modal-img"
                                                    src="{{ $salary->employee->photo ?: asset('images/no_image.jpg') }}"
                                                    alt="Employee Photo" srcset=""></td>
                                            <td class="align-middle"> {{ $salary->employee->name }}</td>
                                            <td class="align-middle" name="amount">{{ $salary->amount }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('salaries.edit', ['salary' => $salary->id]) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-pencil"></span></a>
                                                <form action="{{ route('salaries.destroy', ['salary' => $salary->id]) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-danger rounded-pill waves-effect waves-light delete-button"><span
                                                            class="mdi mdi-delete"></span></button>
                                                </form>
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
        numberSeparatorDataTable('amount');
    </script>

    <!-- Modal Image js-->
    <script src="{{ asset('backend/assets/js/modal-image.js') }}"></script>
@endsection
