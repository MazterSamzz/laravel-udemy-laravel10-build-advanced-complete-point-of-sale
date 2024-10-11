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
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-2">Sales Status</h4>

            <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#awaiting" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                        aria-selected="false" tabindex="-1" role="tab">
                        Awaiting Payment
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#cancel" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false"
                        tabindex="-1" role="tab">
                        Canceled
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#paid" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true"
                        role="tab">
                        Paid
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#refund" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false"
                        tabindex="-1" role="tab">
                        Refund
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                @foreach ($sales as $payment_status => $sale)
                    <div class="tab-pane {{ $payment_status == 'awaiting' ? 'active' : '' }}" id="{{ $payment_status }}"
                        role="tabpanel">
                        <h4 class="header-title">Sales {{ $payment_status }}</h4>

                        <table class="datatable table table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($sale as $key => $value)
                                    <tr>
                                        <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $value->date }}</td>
                                        <td> <img class="avatar-md img-thumbnail modal-trigger" alt="Product Image"
                                                data-bs-toggle="modal"
                                                data-bs-target="#imageModal{{ $payment_status . $key }}"
                                                src="{{ asset($value->customer->photo ?: 'images/no_image.jpg') }}">
                                        </td>
                                        <td class="align-middle">{{ $value->customer->name }}</td>
                                        <td class="align-middle">{{ $value->status }}</td>
                                        <td class="align-middle text-end pe-5">
                                            {{ number_format($value->total, 2, '.', ',') }}
                                        </td>
                                        <td class="align-middle text-center">

                                            @if ($payment_status == 'awaiting')
                                                @switch($value->payment_status)
                                                    @case(App\Enums\PaymentStatus::Unpaid)
                                                        <span class="badge bg-info">Unpaid</span>
                                                    @break

                                                    @case(App\Enums\PaymentStatus::NotYet)
                                                        <span class="badge bg-info">Not Yet</span>
                                                    @break

                                                    @case(App\Enums\PaymentStatus::Overdue)
                                                        <span class="badge bg-danger">Overdue</span>
                                                    @break
                                                @endswitch
                                            @elseif ($payment_status == 'cancel')
                                                @switch($value->payment_status)
                                                    @case(App\Enums\PaymentStatus::Canceling)
                                                        <span class="badge bg-warning">Canceling</span>
                                                    @break

                                                    @case(App\Enums\PaymentStatus::Canceled)
                                                        <span class="badge bg-info">Canceled</span>
                                                    @break
                                                @endswitch
                                            @elseif ($payment_status == 'paid')
                                                @switch($value->payment_status)
                                                    @case(App\Enums\PaymentStatus::Authorized)
                                                        <span class="badge bg-info">Authorized</span>
                                                    @break

                                                    @case(App\Enums\PaymentStatus::Paid)
                                                        <span class="badge bg-success">Paid</span>
                                                    @break
                                                @endswitch
                                            @elseif ($payment_status == 'refund')
                                                @switch($value->payment_status)
                                                    @case(App\Enums\PaymentStatus::Refunding)
                                                        <span class="badge bg-warning">Refunding</span>
                                                    @break

                                                    @case(App\Enums\PaymentStatus::Refunded)
                                                        <span class="badge bg-info">Refunded</span>
                                                    @break
                                                @endswitch
                                            @endif
                                        </td>

                                        <td class="align-middle">
                                            <a href="{{ route('sales.edit', ['sale' => $value->id]) }}"
                                                class="btn btn-blue rounded-pill waves-effect waves-light me-2"><span
                                                    class="mdi mdi-pencil"></span></a>
                                            @if ($value->payment_status->value > App\Enums\PaymentStatus::Paid->value)
                                                <a href="{{ route('sales.show', ['sale' => $value->id]) }}"
                                                    class="btn btn-info rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-eye"></span></a>
                                            @elseif ($value->payment_status->value > App\Enums\PaymentStatus::Canceled->value)
                                                <a href="{{ route('sales.show', ['sale' => $value->id]) }}"
                                                    class="btn btn-info rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-printer"></span></a>
                                            @elseif ($value->payment_status->value > App\Enums\PaymentStatus::Overdue->value)
                                                <a href="{{ route('sales.show', ['sale' => $value->id]) }}"
                                                    class="btn btn-info rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-eye"></span></a>
                                            @else
                                                <a href="{{ route('sales.show', ['sale' => $value->id]) }}"
                                                    class="btn btn-info rounded-pill waves-effect waves-light me-2"><span
                                                        class="mdi mdi-eye"></span></a>
                                            @endif

                                            <form action="{{ route('sales.destroy', ['sale' => $value->id]) }}}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light delete-button"><span
                                                        class="mdi mdi-delete"></span></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal for Large Image -->
                                    <div class="modal fade" id="imageModal{{ $payment_status . $key }}" tabindex="-1"
                                        aria-labelledby="imageModalLabel{{ $payment_status . $key }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <button type="button"
                                                        class="btn-close position-absolute top-0 end-0 m-2"
                                                        data-bs-dismiss="modal"aria-label="Close"></button>
                                                    <img class="img-fluid"
                                                        src="{{ asset($value->customer->photo ?: 'images/no_image.jpg') }}"
                                                        alt="Large Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End Modal for Large Image -->
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end card-->
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

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables untuk tabel yang aktif saat halaman dimuat
            $('.tab-pane.active .datatable').DataTable();

            // Ketika tab baru ditampilkan
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {
                // Menghentikan semua DataTables yang sudah ada
                $.fn.dataTable.tables({
                    visible: true,
                    api: true
                }).columns.adjust();

                // Inisialisasi DataTables untuk tabel yang baru ditampilkan
                $('.tab-pane.active .datatable').DataTable();
            });
        });
    </script>
@endsection
