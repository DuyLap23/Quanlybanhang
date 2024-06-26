@extends('admin.layouts.master')
@section('title')
    Xem chi tiết danh mục {{ $model->name }}
@endsection
@section('content')
    <div class="mb-5 d-flex justify-content-between ">
        <strong><h5 class="card-title mb-0">Chi Tiết Danh Mục</h5></strong>
    </div>
   
    <div class="table-responsive table-card">
        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    {{-- <th scope="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                            <label class="form-check-label" for="cardtableCheck"></label>
                        </div>
                    </th> --}}

                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Is Active</th>
                    <th scope="col">Create at</th>
                    <th scope="col">Update at</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{-- <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                            <label class="form-check-label" for="cardtableCheck01"></label>
                        </div>
                    </td> --}}
                    <td><a href="#" class="fw-semibold">{{ $model->id }}</a></td>
                    <td>{{ $model->name }}</td>
                    <td><img src="{{ Storage::url($model->cover) }}" width="50px"></td>
                    <td>{!! $model->is_active
                        ? '<span class="badge bg-success"> Yes</span>'
                        : '<span class="badge bg-danger"> No</span>' !!}</td>
                    <td>{{ $model->created_at }}</td>
                    <td>{{ $model->updated_at }}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="mt-5 mx">
        <a href="{{ route('admin.catalogues.index') }}" class="btn btn-primary"> Back to list</a>
    </div>  
@endsection
