@extends('admin.layouts.master')
@section('title')
    Thêm Mới Sản Phẩm
@endsection
@section('content')
    {{-- title  --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm Mới Sản Phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản Phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm Mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    {{-- end title  --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"}}">
        @csrf

        {{-- content  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Điền Thông Tin</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                {{-- Col right  --}}

                                <div class="col-md-3">
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            name="name"value="{{ old('name') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="sku" class="form-label">Sku</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ Strtoupper(Str::random(8)) }}" value="{{ old('sku') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" class="form-control" id="price_regular" name="price_regular"
                                            value="0"value="{{ old('price_regular') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" class="form-control" id="price_sale" name="price_sale"
                                            value="0" value="{{ old('price_sale') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="catelogue_id" class="form-label">Catelogues</label>
                                        <select class="form-control" name="catelogue_id">
                                            @foreach ($catelogues as $id => $value)
                                                <option value="{{ $id }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Img Thumbnail</label>
                                        <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                                    </div>
                                </div>

                                {{-- Col left --}}

                                <div class="col-md-9">
                                    <div class="row">
                                        @foreach ($properties as $key => $property)
                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        role="{{ $property }}"name="{{ $property }}"
                                                        id="{{ $property }}" checked>
                                                    <label class="form-check-label"
                                                        for="{{ $property }}">{{ $key }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                    </div>
                                    <div>
                                        <label for="material" class="form-label">Material</label>
                                        <textarea class="form-control" id="material" name="material" rows="2"></textarea>
                                    </div>
                                    <div>
                                        <label for="user_manual" class="form-label">User manual</label>
                                        <textarea class="form-control" id="user_manual" name="user_manual" rows="2"></textarea>
                                    </div>
                                    <div>
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control" id="content" name="content"></textarea>
                                    </div>

                                </div>

                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        {{-- end content  --}}
        {{-- variant  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Variant</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" style="height: 300px ; overflow: scroll">
                                <table class="table table-nowrap ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Size</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sizes as $sizeId => $sizeName)
                                            @php($flagRowspan = true)
                                            @foreach ($colors as $colorId => $colorName)
                                                <tr>

                                                    @if ($flagRowspan)
                                                        <td  class="text-center" style="vertical-align: middle;"
                                                            rowspan="{{ count($colors) }}"><b>{{ $sizeName }}</b>
                                                        </td>
                                                    @endif
                                                    @php($flagRowspan = false)
                                                    <td>
                                                        <button style="background-color: {{ $colorName }};"
                                                            type="button" class="btn btn-primary btn-md"></button>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" value="10"
                                                            name="product_variants[{{ $sizeId . '-' . $colorId }}][quantity]"
                                                            id="quantity">
                                                    </td>
                                                    <td>
                                                        <input type="file"
                                                            name="product_variants[{{ $sizeId . '-' . $colorId }}][image]"
                                                            id="image" class="form-control">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        {{-- end variant --}}
        {{-- Gallery --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-success" onclick="addImageGallery()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                <div class="col-md-4" id="gallery_default_item">
                                    <label for="gallery_default" class="form-label">Image</label>
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="product_galleries[]"
                                               id="gallery_default">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div><!--end col-->
        </div>
        {{-- end gallery  --}}
        {{-- tag --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <h6 class="fw-semibold">Tag</h6>
                                <select class="js-example-basic-multiple" name="tags[]" id="tags" multiple="multiple">

                                    @foreach ($tags as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div><!--end col-->
        </div>
        {{-- end tag  --}}
        {{-- submit --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div><!--end col-->
        </div>
        {{-- end submit  --}}
    </form>
@endsection


@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('content');
        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }

    </script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('themes/admin/assets/js/pages/select2.init.js') }}"></script>
@endsection

