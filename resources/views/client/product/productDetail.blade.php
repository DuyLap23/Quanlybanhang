@extends('client.layouts.master')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach ($product->galleries as $gallery)
                                    @php
                                        $url = $gallery->image;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp
                                    <div class="item-slick3" data-thumb="{{ $url }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $url }}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ $url }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h4>

                        <span class="mtext-106 cl2">
                            <b>
                                {{ $product->price_sale == 0 ? number_format($product->price_regular, 2) : number_format($product->price_sale, 2) }}
                            </b>
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            Chất liệu :
                            {{ $product->material }}
                        </p>

                        <p class="stext-102 cl3 p-t-23">
                            Mô tả :
                            {{ $product->description }}
                        </p>
                        <p class="stext-102 cl3 p-t-23">
                            Nội dung :
                            {{ $product->content }}
                        </p>
                        <p class="stext-102 cl3 p-t-23">
                            Huong dẫn :
                            {{ $product->user_manual }}
                        </p>

                        <!--  -->
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="product_size_id">
                                                <option>Choose an option</option>

                                                @foreach ($sizes as $key => $size)
                                                    <option value="{{ $key }}">{{ $size }}</option>
                                                @endforeach


                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="product_color_id">
                                                <option>Choose an option</option>
                                                @foreach ($colors as $key => $color)
                                                    <option value="{{ $key }} ">
                                                        <button style="background-color: {{ $color }};"
                                                            type="button" class="btn btn-primary btn-md">
                                                            {{ $colorNames[$color] }}
                                                        </button>
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="quantities" value="1" min="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button type ="submit"
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
