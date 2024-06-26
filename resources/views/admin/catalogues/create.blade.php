@extends('admin.layouts.master')
@section('title')
    Thêm Mới Danh Mục
@endsection
@section('content')
    {{-- @if ( session()->has('error') )
<div class="alert alert-danger">
    Vui lòng kiểm tra lại
</div>
@endif --}}

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm Mới Danh Mục</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Danh mục</a></li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>

        </div>
    </div>
</div>
    <form action="{{ route('admin.catalogues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 d-flex justify-content-between ">
            <strong>
                <h5 class="card-title mb-0">Thêm Danh Mục Mới</h5>
            </strong>
        </div>

        <div class="mb-3 mt-3 float-end ">
            <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" checked
                value="{{ old('is_active') }}">
            <label for="is_active" class="form-check-label">Is Active</label>

        </div>

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name " placeholder="Enter name "
                value="{{ old('name') }}">
            @error('name')
                <div class=" text-danger"> *{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="cover" class="form-label">File</label>
            <input type="file" class="form-control" name="cover" id="cover " placeholder="Enter cover "
                value="{{ old('cover') }}">
            @error('cover')
                <div class=" text-danger"> *{{ $message }}</div>
            @enderror
        </div>



        <div class="mb-3 mt-3">
            <button class="btn btn-primary" type="submit">Submit</button>
            <a href=" {{ route('admin.catalogues.index') }}" class="btn btn-danger">Back to list</a>
        </div>
    </form>
@endsection
