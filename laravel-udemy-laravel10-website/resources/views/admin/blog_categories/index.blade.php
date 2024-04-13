@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Portfolio All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Portfolio All Data</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Blog Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php ($i=1)
                                @foreach ($blog_categories as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('blog-categories.edit', $item->slug) }}" class="btn btn-info sm me-2" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            {{-- <a href="{{ route('delete.portfolio', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a> --}}
                                            <form action="{{ route('blog-categories.destroy', ['blog_category' => $item->slug]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button id="delete" class="btn btn-danger sm" title="Delete Data" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
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