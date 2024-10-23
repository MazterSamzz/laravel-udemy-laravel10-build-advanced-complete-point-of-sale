@extends('admin.layouts.admin_dashboard')

@section('css')
    <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Add Role Permissions</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Role Permissions</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('role-has-permissions.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-group me-1"></i>
                                    Add Role Permissions</h5>

                                <div class="row">

                                    <div class="col-md-6 mb-2" data-select2-id="7">
                                        <p class="mb-1 fw-bold text-muted">Single Select</p>

                                        <select class="form-control select2-hidden-accessible" data-toggle="select2"
                                            data-width="100%" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                            id="single_select">
                                            <option data-select2-id="3">Select</option>
                                            <optgroup label="Alaskan/Hawaiian Time Zone" data-select2-id="14">
                                                <option value="AK" data-select2-id="15">Alaska</option>
                                                <option value="HI" data-select2-id="16">Hawaii</option>
                                            </optgroup>
                                            <optgroup label="Pacific Time Zone" data-select2-id="17">
                                                <option value="CA" data-select2-id="18">California</option>
                                                <option value="NV" data-select2-id="19">Nevada</option>
                                                <option value="OR" data-select2-id="20">Oregon</option>
                                                <option value="WA" data-select2-id="21">Washington</option>
                                            </optgroup>
                                            <optgroup label="Mountain Time Zone" data-select2-id="22">
                                                <option value="AZ" data-select2-id="23">Arizona</option>
                                                <option value="CO" data-select2-id="24">Colorado</option>
                                                <option value="ID" data-select2-id="25">Idaho</option>
                                                <option value="MT" data-select2-id="26">Montana</option>
                                                <option value="NE" data-select2-id="27">Nebraska</option>
                                                <option value="NM" data-select2-id="28">New Mexico</option>
                                                <option value="ND" data-select2-id="29">North Dakota</option>
                                                <option value="UT" data-select2-id="30">Utah</option>
                                                <option value="WY" data-select2-id="31">Wyoming</option>
                                            </optgroup>
                                            <optgroup label="Central Time Zone" data-select2-id="32">
                                                <option value="AL" data-select2-id="33">Alabama</option>
                                                <option value="AR" data-select2-id="34">Arkansas</option>
                                                <option value="IL" data-select2-id="35">Illinois</option>
                                                <option value="IA" data-select2-id="36">Iowa</option>
                                                <option value="KS" data-select2-id="37">Kansas</option>
                                                <option value="KY" data-select2-id="38">Kentucky</option>
                                                <option value="LA" data-select2-id="39">Louisiana</option>
                                                <option value="MN" data-select2-id="40">Minnesota</option>
                                                <option value="MS" data-select2-id="41">Mississippi</option>
                                                <option value="MO" data-select2-id="42">Missouri</option>
                                                <option value="OK" data-select2-id="43">Oklahoma</option>
                                                <option value="SD" data-select2-id="44">South Dakota</option>
                                                <option value="TX" data-select2-id="45">Texas</option>
                                                <option value="TN" data-select2-id="46">Tennessee</option>
                                                <option value="WI" data-select2-id="47">Wisconsin</option>
                                            </optgroup>
                                            <optgroup label="Eastern Time Zone" data-select2-id="48">
                                                <option value="CT" data-select2-id="49">Connecticut</option>
                                                <option value="DE" data-select2-id="50">Delaware</option>
                                                <option value="FL" data-select2-id="51">Florida</option>
                                                <option value="GA" data-select2-id="52">Georgia</option>
                                                <option value="IN" data-select2-id="53">Indiana</option>
                                                <option value="ME" data-select2-id="54">Maine</option>
                                                <option value="MD" data-select2-id="55">Maryland</option>
                                                <option value="MA" data-select2-id="56">Massachusetts</option>
                                                <option value="MI" data-select2-id="57">Michigan</option>
                                                <option value="NH" data-select2-id="58">New Hampshire</option>
                                                <option value="NJ" data-select2-id="59">New Jersey</option>
                                                <option value="NY" data-select2-id="60">New York</option>
                                                <option value="NC" data-select2-id="61">North Carolina</option>
                                                <option value="OH" data-select2-id="62">Ohio</option>
                                                <option value="PA" data-select2-id="63">Pennsylvania</option>
                                                <option value="RI" data-select2-id="64">Rhode Island</option>
                                                <option value="SC" data-select2-id="65">South Carolina</option>
                                                <option value="VT" data-select2-id="66">Vermont</option>
                                                <option value="VA" data-select2-id="67">Virginia</option>
                                                <option value="WV" data-select2-id="68">West Virginia</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <!-- Roles -->
                                    <div class="col-md-6 mb-3">
                                        <label for="role_id" class="form-label">Role Name</label>
                                        <select class="form-control" id="role_id" name="role_id" data-toggle="select2"
                                            data-width="100%">
                                            <option value="" selected disabled>---- Select Role Name ----
                                            </option>
                                            @foreach ($roles as $item)
                                                <option {{ old('role_id') ? 'selected' : '' }} value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div><!-- End of Roles -->

                                    <div class="form-check form-switch form-check-primary">
                                        <input class="form-check-input" type="checkbox" value="all" id="all">
                                        <label class="form-check-label text-capitalize" for="all">all
                                            check</label>
                                    </div>

                                    <div class="row">
                                        @foreach ($permissionGroups as $group => $permissions)
                                            @if ($loop->iteration % 2 == 1)
                                                <div class="border-top my-2 w-100"></div>
                                            @endif
                                            <div class="col-12 col-sm-6 col-md-2">
                                                <div class="form-check form-switch mb-2 form-check-success">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="{{ $group }}">
                                                    <label class="form-check-label text-capitalize"
                                                        for="{{ $group }}">{{ $group }}</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4">
                                                @foreach ($permissions as $permission)
                                                    <div class="form-check form-switch form-check-primary">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permissions[]" value="{{ $permission->encryptedId }}"
                                                            id="{{ $permission->encryptedId }}">
                                                        <label class="form-check-label text-capitalize"
                                                            for="{{ $permission->encryptedId }}">
                                                            {{ str_replace('.', ' ', $permission->name) }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
                                    </div>
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
    <script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#role_id').select2();
            $('#single_select').select2();
        });
        $('#all').click(function() {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        })
    </script>

    <script>
        $(document).ready(function() {
            // Ketika checkbox light mode diubah
            $('#light-mode-check').change(function() {
                if ($(this).is(':checked')) {
                    // Hapus CSS dark mode jika light mode diaktifkan
                    $('link[href="{{ asset('backend/assets/libs/select2/css/select2.dark.css') }}"]')
                        .remove();
                }
            });

            // Ketika checkbox dark mode diubah
            $('#dark-mode-check').change(function() {
                if ($(this).is(':checked')) {
                    // Tambahkan CSS dark mode jika dark mode diaktifkan
                    if (!$('link[href="{{ asset('backend/assets/libs/select2/css/select2.dark.css') }}"]')
                        .length) {
                        $('<link/>', {
                            rel: 'stylesheet',
                            type: 'text/css',
                            href: '{{ asset('backend/assets/libs/select2/css/select2.dark.css') }}'
                        }).appendTo('head');
                    }
                    // Nonaktifkan light mode
                    $('#light-mode-check').prop('checked', false);
                }
            });

            // Set initial theme
            if ($('#dark-mode-check').is(':checked')) {
                $('<link/>', {
                    rel: 'stylesheet',
                    type: 'text/css',
                    href: '{{ asset('backend/assets/libs/select2/css/select2.dark.css') }}'
                }).appendTo('head');
            }
        });
    </script>
@endsection
