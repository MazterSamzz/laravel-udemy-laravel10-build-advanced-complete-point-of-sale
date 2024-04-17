@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Footer Page</h4>

                            <form method="post" action="{{ route('footer.update') }}">
                                @csrf
                                @method('put')

                                <input type="hidden" name="id" value="{{ $footer->id }}">

                                <!-- Input number -->
                                <div class="row mb-3">
                                    <label  for="number" class="col-sm-2 col-form-label">Number</label> 
                                    <div class="col-sm-10">
                                        <input id="number" name="number" class="form-control" type="text" placeholder="Number" value="{{ old('number') ? old('number') : $footer->number }}" />
                                    </div>
                                    @error('number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Input number -->
                                
                                <!-- // Short description -->
                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="short_description" name="short_description" class="form-control" required="" rows="5">{{ old('short_description') ? old('short_description') : $footer->short_description }}</textarea>
                                    </div>
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Short description -->
                                
                                <!-- // Input address -->
                                <div class="row mb-3">
                                    <label  for="address" class="col-sm-2 col-form-label">Address</label> 
                                    <div class="col-sm-10">
                                        <input id="address" name="address" class="form-control" type="text" placeholder="Address" value="{{ old('address') ? old('address') : $footer->address }}" />
                                    </div>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Input address -->
                                
                                <!-- // Input email -->
                                <div class="row mb-3">
                                    <label  for="email" class="col-sm-2 col-form-label">Email</label> 
                                    <div class="col-sm-10">
                                        <input id="email" name="email" class="form-control" type="text" placeholder="Email" value="{{ old('email') ? old('email') : $footer->email }}" />
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Input email -->
                                
                                <!-- // Input facebook -->
                                <div class="row mb-3">
                                    <label  for="facebook" class="col-sm-2 col-form-label">Facebook</label> 
                                    <div class="col-sm-10">
                                        <input id="facebook" name="facebook" class="form-control" type="text" placeholder="Facebook" value="{{ old('facebook') ? old('facebook') : $footer->facebook }}" />
                                    </div>
                                    @error('facebook')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Input facebook -->
                                
                                <!-- // Input twitter -->
                                <div class="row mb-3">
                                    <label  for="twitter" class="col-sm-2 col-form-label">Twitter</label> 
                                    <div class="col-sm-10">
                                        <input id="twitter" name="twitter" class="form-control" type="text" placeholder="Twitter" value="{{ old('twitter') ? old('twitter') : $footer->twitter }}" />
                                    </div>
                                    @error('twitter')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Input twitter -->
                                
                                <!-- // Input Copyright -->
                                <div class="row mb-3">
                                    <label  for="copyright" class="col-sm-2 col-form-label">Copyright</label> 
                                    <div class="col-sm-10">
                                        <input id="copyright" name="copyright" class="form-control" type="text" placeholder="Copyright" value="{{ old('copyright') ? old('copyright') : $footer->copyright }}" />
                                    </div>
                                    @error('copyright')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end of Input address -->
                                
                                
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