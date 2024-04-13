@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Blog Category</h4>

                            <form method="post" action="{{ route('blog-categories.store') }}" enctype="multipart/form-data">
                                @csrf

                                {{-- Input Blog Category --}}
                                <div class="row mb-3">
                                    <label  for="blog_category_name" class="col-sm-2 col-form-label">Blog Category Name</label> 
                                    <div class="col-sm-10">
                                        {{-- <input id="blog_category_name" name="blog_category_name" class="form-control" type="text" placeholder="Blog Category Name" value="{{ old('blog_category_name') }}" autofocus /> --}}
                                        <select name="blog_category_id" id="blog_category_name" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        @error('blog_category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end of Blog Category -->
                                
                                {{-- Input Title --}}
                                <div class="row mb-3">
                                    <label  for="title" class="col-sm-2 col-form-label">Blog Title</label> 
                                    <div class="col-sm-10">
                                        <input id="title" name="title" class="form-control" type="text" placeholder="Blog Title" value="{{ old('title') }}" />
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end of Input Title -->

                                {{-- Input Image --}}
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">Blog Image</label>
                                    <div class="col-sm-10">
                                        <input id="image" name="image" class="form-control" type="file" placeholder="Blog Image" />
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end of Input Image-->

                                {{-- Show Image --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src=
                                            "{{ (!empty($portfolio->portfolio_image)) ?
                                            url($portfolio->portfolio_image) :
                                            url('upload/no_image.jpg') }}"

                                            alt="Card image cap">
                                    </div>
                                </div> <!-- end of Show Image -->

                                {{-- Input Description --}}
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Blog Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end of Input Description -->

                                {{-- Input Tag --}}
                                <div class="row mb-3">
                                    <label  for="tags" class="col-sm-2 col-form-label">Blog Tag</label> 
                                    <div class="col-sm-10">
                                        <input id="tags" name="tags" class="form-control" type="text" placeholder="Blog Tags" value="{{ old('tags') }}" data-role="tagsinput" />
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end of Input Tag -->
                                <input type="submit" value="Insert Blog Category" class="btn btn-info btn-round">
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