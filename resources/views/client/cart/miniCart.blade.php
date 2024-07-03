@extends('client.layouts.master')
@section( 'content')

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			{{-- mini cart  --}}
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						@if(session()->has('cart'))
						@foreach(session('cart') as  $value)
						@php
							$total = $value['quantities'] * ($value['price_sale'] ? $value['price_sale'] : $value['price_regular']);
						@endphp
						<div class="header-cart-item-img">
							@php
                                $url = $value['img_thumbnail'];

                                if (!\Str::contains($url, 'http')) {
                                    $url = Storage::url($url);
                                }
                            @endphp
							<img src="{{$url}}"width="80px" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								{{$value['name']}}
							</a>

							<span class="header-cart-item-info">
								{{$value['quantities']}} x $ {{ $value['price_sale'] ? number_format($value['price_sale'], 2)  : number_format($value['price_regular'], 2)  }}
							</span>
						</div>


							@endforeach	
						@endif
					</li>

					
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						
						Total: $ {{
							number_format($total, 2)
						}}
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection