@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Home Slide Page</h4>

                            <form method="post" action="{{ route('update.slider', ['id' => $homeslide->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row mb-3">
                                    <label  for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input id="title" name="title" class="form-control" type="text" placeholder="Title" value="{{ $homeslide->title }}" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input id="short_title" name="short_title" class="form-control" type="text" placeholder="Short Title" value="{{ $homeslide->short_title }}" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="video_url" class="col-sm-2 col-form-label">Video Url</label>
                                    <div class="col-sm-10">
                                        <input id="video_url" name="video_url" class="form-control" type="text" placeholder="Video Url" value="{{ $homeslide->video_url }}" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label for="home_slide" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input id="home_slide" name="home_slide" class="form-control" type="file" placeholder="Slider Image" />
                                    </div>
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src=
                                            "{{ (!empty($homeslide->home_slide)) ?
                                            url($homeslide->home_slide) :
                                            url('upload/no_image.jpg') }}"

                                            alt="Card image cap">
                                    </div>
                                </div> <!-- end row -->
                                <input type="submit" value="Update Slide" class="btn btn-info btn-round">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#home_slide').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection