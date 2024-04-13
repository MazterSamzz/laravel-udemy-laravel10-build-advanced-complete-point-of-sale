@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Blog Category</h4>

                            <form method="post" action="{{ route('blog-categories.store') }}" enctype="multipart/form-data">
                                @csrf

                                {{-- Input Category Name --}}
                                <div class="row mb-3"> 
                                    <label  for="name" class="col-sm-2 col-form-label">Blog Category Name</label> 
                                    <div class="col-sm-10">
                                        <input id="name" name="name" class="form-control" type="text" placeholder="Blog Category Name" value="{{ old('name') }}" autofocus />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end row -->
                                <input type="submit" value="Insert Blog Category" class="btn btn-info btn-round">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection