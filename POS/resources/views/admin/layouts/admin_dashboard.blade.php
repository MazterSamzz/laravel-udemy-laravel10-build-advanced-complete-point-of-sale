<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Easy POS System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Plugins css -->
    <link href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('backend/assets/js/head.js') }}"></script>
    <!-- Toastr css -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<!-- body start -->

<body data-layout-mode="default" data-theme="dark" data-topbar-color="dark" data-menu-position="fixed"
    data-leftbar-color="dark" data-leftbar-size='default' data-sidebar-user='false'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('admin.layouts.header')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            @yield('admin')

            <!-- Footer Start -->
            @include('admin.layouts.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('admin.layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('backend/assets/js/pages/dashboard-1.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

    <!-- Toastr js-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @include('admin.layouts.lib.toastr')

    @yield('scripts')
</body>

</html>
