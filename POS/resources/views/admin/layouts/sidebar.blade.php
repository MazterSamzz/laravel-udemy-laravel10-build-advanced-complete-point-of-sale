<div class="left-side-menu">
    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('backend/assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pos.index') }}">
                        <span class="badge bg-pink float-end">Hot</span>
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> POS </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Apps</li>

                <!-- ================ Master Data ================ -->
                <li>
                    <a href="#masterData" data-bs-toggle="collapse">
                        <i class="mdi mdi-bookmark-multiple-outline"></i>
                        <span> Master Data</span> <span class="menu-arrow"></a>
                    <div class="collapse" id="masterData">
                        <ul class="nav-second-level">

                            <!-- ================ Employees ================ -->
                            <li>
                                <a href="#sidebarEmployeeManagement" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Employees</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmployeeManagement">
                                    <ul class="nav-second-level">
                                        <!-- ================ Employees ================ -->
                                        <li>
                                            <a href="#sidebarEmployee" data-bs-toggle="collapse">
                                                <i class="mdi mdi-account-group"></i>
                                                <span> Employee</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarEmployee">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="{{ route('employees.index') }}">All Employee</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('employees.create') }}">Add Employee</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- ================ End of Employees ================ -->

                                        <!-- ================ Salaries ================ -->
                                        <li>
                                            <a href="#sidebarSalary" data-bs-toggle="collapse">
                                                <i class="mdi mdi-email-multiple-outline"></i>
                                                <span>Salary</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarSalary">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="{{ route('advance-salaries.index') }}">All Advance
                                                            Salary</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('advance-salaries.create') }}">Add Advance
                                                            Salary</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('salaries.create') }}">Pay Salary</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('salaries.index') }}">Paid Salary</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- ================ End of Salaries ================ -->

                                        <!-- ================ Attendances ================ -->
                                        <li>
                                            <a href="#sidebarAttendances" data-bs-toggle="collapse">
                                                <i class="mdi mdi-email-multiple-outline"></i>
                                                <span> Attendances </span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarAttendances">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="{{ route('attendances.index') }}">All Attendances</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('attendances.create') }}">Add Attendance</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- ================ End of Attendances ================ -->
                                    </ul>
                                </div>
                            </li>
                            <!-- ================ End of Employees ================ -->

                            <!-- ================ Role and Permissions ================ -->
                            <li>
                                <a href="#sidebarRoleAndPermissions" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Roles & Permissions</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarRoleAndPermissions">
                                    <ul class="nav-second-level">
                                        <!-- ================ Permissions ================ -->
                                        <li>
                                            <a href="{{ route('permissions.index') }}">Permissions</a>
                                        </li>
                                        <!-- ================ End of Permissions ================ -->
                                        <!-- ================ Roles ================ -->
                                        <li>
                                            <a href="{{ route('roles.index') }}">Roles</a>
                                        </li>
                                        <!-- ================ End of Roles ================ -->
                                    </ul>
                                </div>
                            </li>
                            <!-- ================ End of Role and Permissions ================ -->

                            <!-- ================ Categories ================ -->
                            <li>
                                <a href="#sidebarCategory" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Categories</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCategory">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('categories.index') }}">All Categories</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- ================ End of Categories ================ -->

                            <!-- ================ Products ================ -->
                            <li>
                                <a href="#sidebarProduct" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Products</span> <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarProduct">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('products.index') }}">All Products</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.create') }}">Add Product</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.import.page') }}">Import</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- ================ End of Products ================ -->

                        </ul>
                    </div>
                </li>
                <!-- ================ End of Master Data ================ -->

                <!-- ================ Sales ================ -->
                <li>
                    <a href="#sidebarSales" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-group"></i>
                        <span> Sales</span> <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSales">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sales.index') }}">All Sales</a>
                            </li>
                            <li>
                                <a href="{{ route('sales.create') }}">Add Sales</a>
                            </li>
                            <li>
                                <a href="{{ route('sales.import.page') }}">Import</a>
                            </li>
                            <!-- ================ Customers ================ -->
                            <li>
                                <a href="#sidebarCustomers" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                    <span> Customer </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomers">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('customers.index') }}">All Customers</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customers.create') }}">Add Customer</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- ================ End of Customers ================ -->
                        </ul>
                    </div>
                </li>
                <!-- ================ End of Sales ================ -->


                <!-- ================ Suppliers ================ -->
                <li>
                    <a href="#sidebarSuppliers" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Suppliers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSuppliers">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('suppliers.index') }}">All Suppliers</a>
                            </li>
                            <li>
                                <a href="{{ route('suppliers.create') }}">Add Supplier</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ================ End of Suppliers ================ -->

                <!-- ================ Custom ================ -->
                <li class="menu-title mt-2">Custom</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Expense </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('expenses.create') }}">Add Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('expenses.filter', ['filter' => 'date']) }}">Today Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('expenses.filter', ['filter' => 'month']) }}">Monthly
                                    Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('expenses.filter', ['filter' => 'year']) }}">Yearly Expense</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ================ End of Custom ================ -->

                <!-- ================ Extra Pages ================ -->
                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="pages-starter.html">Starter</a>
                            </li>
                            <li>
                                <a href="pages-timeline.html">Timeline</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ================ End of Extra Pages ================ -->

            </ul>

        </div><!-- End sidebar-menu -->
    </div> <!-- data-simplebar -->
    <div class="clearfix"></div> <!-- clearfix -->
</div> <!-- Sidebar -left -->
