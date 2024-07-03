<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($slug)
    {   
        $product = Product::query()->with('variants')->where('slug', $slug)->first();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colorNames = [
            '#FFFFFF' => 'white',
            '#000000' => 'Black',
            '#FF0000' => 'Red',
            '#00FF00' => 'Green',
            '#0000FF' => 'Blue  ',
            '#FFFF00' => 'Yellow',
            // Thêm các mã màu và tên màu khác
        ];
        return view('client.product.productDetail',compact('product', 'colors', 'sizes','colorNames'));
    }
}
