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

                            <form id="myForm" method="post" action="{{ route('blog-categories.store') }}">
                                @csrf

                                {{-- Input Category Name --}}
                                <div class="row mb-3">
                                    <label  for="name" class="col-sm-2 col-form-label">Blog Category Name</label> 
                                    <div class="form-group col-sm-10">
                                        <input id="name" name="name" class="form-control" type="text" placeholder="Blog Category Name" value="{{ old('name') }}" autofocus />
                                        {{-- @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    },
                },
                messages: {
                    name: {
                        required : 'Please Enter Blog Category',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            })
        })
    </script>
@endsection