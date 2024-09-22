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
                                <li class="breadcrumb-item active"><a href="javascript: void(0);">Sales Invoice</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Invoice</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo & title -->
                            <div class="clearfix">
                                <div class="float-start">
                                    <div class="auth-logo">
                                        <div class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                                    height="22">
                                            </span>
                                        </div>

                                        <div class="logo logo-light">
                                            <span class="logo-lg">
                                                <img src="{{ asset('backend/assets/images/logo-light.png') }}"
                                                    alt="" height="22">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b>Hello, {{ $customer->name }}</b></p>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <h6>Billing Address</h6>
                                            <address>
                                                <div>{{ $customer->address ?? 'N/A' }} -
                                                    {{ $customer->city ?? 'N/A' }}</div>
                                                <div><strong>Shop Name:</strong> {{ $customer->shopname ?? 'N/A' }} <br>
                                                </div>
                                                <div><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }} <br></div>
                                                <div><strong>Email:</strong> {{ $customer->email ?? 'N/A' }} <br></div>
                                            </address>
                                        </div> <!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end col -->
                                <div class="col-md-4 offset-md-2">
                                    <div class="clearfix">
                                        <div class="mt-3 float-end">
                                            <div><strong>Invoice Date : </strong> <span class="float-end">
                                                    Jan 17, 2016</span></div>
                                            <div><strong>Invoice Status : </strong> <span class="float-end"><span
                                                        class="badge bg-danger">Unpaid</span></span></div>
                                            <div><strong>Invoice No. : </strong> <span class="float-end">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->



                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4 table-centered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width: 5%">#</th>
                                                    <th style="width: 70%">Item</th>
                                                    <th style="width: 5%">Qty</th>
                                                    <th style="width: 10%">Unit Cost</th>
                                                    <th style="width: 10%">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($carts as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-end">{{ number_format($item->qty) }}</td>
                                                        <td class="text-end">{{ number_format($item->price) }}</td>
                                                        <td class="text-end">{{ number_format($item->subtotal) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">

                                <div class="col-sm-12 col-md-6 order-md-2">
                                    <div class="clearfix">
                                        <div class="float-end">
                                            <p><b class="float-left">Sub-total: </b> <span
                                                    class="float-end">{{ $invoice['subtotal'] }}</span>
                                            </p>
                                            <p class="float-left"><b>Tax ({{ $invoice['tax-rate'] }}%): </b> <span
                                                    class="float-end">
                                                    {{ $invoice['tax'] }}</span>
                                            </p>
                                            <h3>Rp. {{ $invoice['total'] }}</h3>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-12 col-md-6 order-md-1">
                                    <h6 class="text-muted">Notes:</h6>

                                    <small class="text-muted">
                                        All accounts are to be paid within 7 days from receipt of
                                        invoice. To be paid by cheque or credit card or direct payment
                                        online. If account is not paid within 7 days the credits details
                                        supplied as confirmation of work undertaken will be charged the
                                        agreed quoted fee noted above.
                                    </small>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="mt-4 mb-1">
                                <div class="text-end d-print-none">
                                    <a href="javascript:window.print()"
                                        class="btn btn-primary waves-effect waves-light me-1"><i
                                            class="mdi mdi-printer me-1"></i> Print</a>
                                    <!-- Create Invoice modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#create-invoice">Create Invoice</button>
                                    <div id="create-invoice" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <div class="text-center mt-2 mb-4">
                                                        <div class="auth-logo">
                                                            <a href="index.html" class="logo logo-dark">
                                                                <span class="logo-lg">
                                                                    <img src="{{ asset('backend/assets/images/logo-dark.png') }}"
                                                                        alt="" height="24">
                                                                </span>
                                                            </a>

                                                            <a href="index.html" class="logo logo-light">
                                                                <span class="logo-lg">
                                                                    <img src="{{ asset('backend/assets/images/logo-light.png') }}"
                                                                        alt="" height="24">
                                                                </span>
                                                            </a>

                                                            <h3>Invoice of {{ $customer->name }}</h3>
                                                            <h3>Total Amount: {{ $invoice['total'] }}</h3>
                                                        </div>
                                                    </div>

                                                    @include('backend.pos.create-invoice-modal')

                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div>
    @endsection

    @section('js')
        <script src="{{ asset('backend/assets/js/numberSeparator.js') }}"></script>

        <script type="text/javascript">
            numberSeparatorById('paid');
        </script>
    @endsection
