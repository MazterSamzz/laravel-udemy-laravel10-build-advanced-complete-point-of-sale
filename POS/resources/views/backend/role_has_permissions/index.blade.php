@extends('admin.layouts.admin_dashboard')

@section('admin')
    <button class="btn btn-success waves-effect waves-light mt-2"><a href="{{ route('role-has-permissions.create') }}"><i
                class="mdi mdi--thick"></i> Add</a></button>
@endsection
