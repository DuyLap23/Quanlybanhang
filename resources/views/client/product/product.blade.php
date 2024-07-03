
        {{-- product  --}}
        <div class="row isotope-grid">
            @foreach ($products as $item => $product)

            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women ">
                <!-- Block2 -->

                <div class="block2">
                        <div class="block2-pic hov-img0 label-new " data-label="New">
                            @php
                                $url = $product->img_thumbnail;

                                if (!\Str::contains($url, 'http')) {
                                    $url = Storage::url($url);
                                }
                            @endphp
                           <a href="{{ route('product-detail', $product->slug) }}"><img src="{{ $url }}" alt="IMG-PRODUCT" width="60px " height="270px " style="border-radius: 13px"></a> 

                            <a href="{{ route('product-detail', $product->slug) }}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{ route('product-detail', $product->slug) }}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ \Str::limit($product->name, 20) }}
                                </a>

                                <div class=" d-flex stext-105 cl3">
                                    <span class="cl3">
                                     <b>  {{ $product->price_sale != 0 ? ' $' .number_format($product->price_sale, 2) : '' }}</b>

                                    </span>

                                    <span class=" stext-105 mx-3 cl3">
                                        @if ($product->price_sale != 0)
                                            <del> ${{number_format($product->price_regular, 2) }}</del>
                                        @endif
                                        @if($product->price_sale == 0)
                                                <b>
                                                    ${{number_format($product->price_regular, 2) }}
                                                </b>

                                            @endif


                                    </span>
                                </div>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="{{ asset('themes/client/#') }}"
                                    class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04"
                                        src="{{ asset('themes/client/images/icons/icon-heart-01.png') }}"
                                        alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                        src="{{ asset('themes/client/images/icons/icon-heart-02.png') }}"
                                        alt="ICON">
                                </a>
                            </div>
                        </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex-c-m flex-w w-full p-t-38">
            <a href="{{ asset('themes/client/#') }}"
                class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                1
            </a>

            <a href="{{ asset('themes/client/#') }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                2
            </a>
        </div>
   
