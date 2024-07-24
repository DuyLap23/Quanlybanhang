@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
@endsection

@section('content')
    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh Sách Sản Phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sản Phẩm</a></li>
                            <li class="breadcrumb-item active">Danh Sách</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Thông tin sản phẩm</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Thêm sản phẩm</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th data-ordering="false">STT</th>
                                <th data-ordering="false">ID</th>
                                <th>Catelogue</th>
                                <th>Image Thumbnail</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price Regular</th>
                                <th>Price Sale</th>
                                <th>View</th>
                                <th>Is Active</th>
                                <th>Is Hot Deal</th>
                                <th>Is Good Deal</th>
                                <th>Is New</th>
                                <th>Is Show Home</th>
                                <th>Tag</th>
                                <th>Create at</th>
                                <th>Update at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $product)
                                <tr>
                                    <td scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                                value="option1">
                                        </div>
                                    </td>
                                    <td>{{ $index }}</td>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->catelogue->name }}</td>
                                    <td>
                                        @php
                                            $url = $product->img_thumbnail;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="50">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->price_regular }}</td>
                                    <td>{{ $product->price_sale }}</td>
                                    <td>{{ $product->views }}</td>
                                    <td>{!! $product->is_active
                                        ? '<span class="badge bg-success"> Yes</span>'
                                        : '<span class="badge bg-danger"> No</span>' !!}</td>
                                    <td>{!! $product->is_hot_deal
                                        ? '<span class="badge bg-success"> Yes</span>'
                                        : '<span class="badge bg-danger"> No</span>' !!}</td>
                                    <td>{!! $product->is_good_deal
                                        ? '<span class="badge bg-success"> Yes</span>'
                                        : '<span class="badge bg-danger"> No</span>' !!}</td>
                                    <td>{!! $product->is_new
                                        ? '<span class="badge bg-success"> Yes</span>'
                                        : '<span class="badge bg-danger"> No</span>' !!}</td>
                                    <td>{!! $product->is_show_home
                                        ? '<span class="badge bg-success"> Yes</span>'
                                        : '<span class="badge bg-danger"> No</span>' !!}</td>
                                    <td>
                                        @foreach ($product->tags as $tag)
                                            <span class="badge bg-primary">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>

                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="#!" class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                </li>
                                                <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.products.edit', $product) }}"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="dropdown-item remove-item-btn" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('delete-form').submit(); }">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    {{--
    <script>
    new DataTable("#example");

</script> --}}
    <script src="{{ asset('themes/admin/assets/js/pages/datatables.init.js') }}"></script>
@endsection
