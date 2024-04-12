@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Page</h4>

                            <form method="post" action="{{ route('update.about') }}" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <input type="hidden" name="id" value="{{ $aboutpage->id }}">

                                <div class="row mb-3">
                                    <label  for="title" class="col-sm-2 col-form-label">Title</label> 
                                    <div class="col-sm-10">
                                        <input id="title" name="title" class="form-control" type="text" placeholder="Title" value="{{ $aboutpage->title }}" />
                                    </div>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input id="short_title" name="short_title" class="form-control" type="text" placeholder="Short Title" value="{{ $aboutpage->short_title }}" />
                                    </div>
                                    @error('short_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="short_description" name="short_description" class="form-control" required="" rows="5">{{ $aboutpage->short_description }}</textarea>
                                    </div>
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="long_description" class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="long_description">{{ $aboutpage->long_description }}</textarea>
                                    </div>
                                    @error('long_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="about_image" class="col-sm-2 col-form-label">About Image</label>
                                    <div class="col-sm-10">
                                        <input id="image" name="about_image" class="form-control" type="file" placeholder="About Image" />
                                    </div>
                                    @error('about_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src=
                                            "{{ (!empty($aboutpage->about_image)) ?
                                            url($aboutpage->about_image) :
                                            url('upload/no_image.jpg') }}"

                                            alt="Card image cap">
                                    </div>
                                </div> <!-- end row -->
                                <input type="submit" value="Update About Page" class="btn btn-info btn-round">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection