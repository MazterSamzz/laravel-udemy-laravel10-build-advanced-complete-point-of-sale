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
                                <li class="breadcrumb-item"><a href="">UBold</a></li>
                                <li class="breadcrumb-item"><a href="">Contacts</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="
                            @empty($user->photo)
                                {{ asset('images/no_image.jpg') }}
                            @endempty
                            @isset($user->photo)
                                {{ asset('images/photos/' . $user->photo) }}
                            @endisset
                            "
                                class="rounded-circle avatar-lg img-thumbnail">
                            <h4 class="mb-0">{{ $user->name }}</h4>
                            <p class="text-muted">{{ $user->email }}</p>

                            <button type="button"
                                class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                            <button type="button"
                                class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                            <div class="text-start mt-3">
                                <p class="text-muted mb-2 font-13"><strong>Username :</strong>
                                    <span class="ms-2">{{ $user->name }}</span>
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>Phone :</strong>
                                    <span class="ms-2">{{ $user->phone }}</span>
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong>
                                    <span class="ms-2">{{ $user->email }}</span>
                                </p>
                            </div>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="" class="social-list-item border-primary text-primary"><i
                                            class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="social-list-item border-danger text-danger"><i
                                            class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="social-list-item border-info text-info"><i
                                            class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col-->

                <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <form method ="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                    Personal Info</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter username" value="{{ $user->name }}"
                                                autocomplete="username" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter email" value="{{ $user->email }}" autocomplete="email">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                placeholder="Enter Phone" value="{{ $user->phone }}" autocomplete="phone">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Admin Profile Image</label>
                                            <input type="file" id="image" name="photo" class="form-control">
                                        </div>
                                        <img id="image-preview"
                                            src="
                                        @empty($user->photo)
                                            {{ asset('images/no_image.jpg') }}
                                        @endempty
                                        @isset($user->photo)
                                            {{ asset('images/photos/' . $user->photo) }}
                                        @endisset
                                        "
                                            class="rounded-circle avatar-lg img-thumbnail">
                                    </div><!-- end col -->
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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
