@extends('admin.layouts.master')
@section('title')
Thêm Mới Danh Mục
@endsection
@section('content')
@if (session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

<form action="{{ route('admin.catalogues.update', $model->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 mt-3 float-end ">
        <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" @if($model->is_active) checked @endif
            value="{{ old('is_active') }}">
        <label for="is_active" class="form-check-label">Is Active</label>  
        @error('is_active')
        <div class=" text-danger"> *{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 mt-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name " placeholder="Enter name" 
            value=" {{ $model->name }} {{ old('name') }} ">
        @error('name')
        <div class=" text-danger"> *{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 mt-3">
        <label for="cover" class="form-label">File</label>
        <input type="file" class="form-control" name="cover" id="cover " placeholder="Enter cover ">
            
        <img src="{{ Storage::url($model->cover) }}" width="50px">

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