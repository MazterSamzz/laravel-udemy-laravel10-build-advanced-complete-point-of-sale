@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Blogs All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Blogs All Data</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Tags</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php ($i=1)
                                @foreach ($blogs as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->tags }}</td>
                                    <td><img src="{{ asset($item->image) }}" alt="" style="width:60px; height:60px;"></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('blogs.edit', $item->slug) }}" class="btn btn-info sm me-2" title="Edit Data"><i class="fas fa-edit fa-xs"></i></a>
                                            @php ($action = route('blogs.destroy', ['blog' => $item->slug]))
                                            @include('admin.parts.form-delete-button')
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->        
    </div> <!-- container-fluid -->
</div><!-- End Page-content -->

@endsection