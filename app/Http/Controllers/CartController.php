<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart(Request $request)
    {
        $cart = session('cart');
        // dd($cart);
        $totalAmount  = 0;
        foreach ($cart as $value) {
            $totalAmount += $value['quantities'] * ($value['price_sale'] ?: $value['price_regular']);
        }

        return view('client.cart.cart',compact('totalAmount'));
    }
    // public function miniCart(Request $request){
    //    return view('client.cart.miniCart');
    // }

    public function add()
    {
        $product = Product::query()->findOrFail(\request('product_id'));
        $productVariant = ProductVariant::query()
            ->with('color', 'size')
            ->where([
                'product_id' => \request('product_id'),
                'product_size_id' => \request('product_size_id'),
                'product_color_id' => \request('product_color_id'),
            ])
            ->firstOrFail();
        if (!isset(session('cart')[$productVariant->id])) {
            $data = $product->toArray() + $productVariant->toArray() + ['quantities' => \request('quantities')];

            session()->put('cart.' . $productVariant->id, $data);
        } else {
            $data = session('cart')[$productVariant->id];
            $data['quantities'] = \request('quantities');
            session()->put('cart.' . $productVariant->id, $data);
        }
        return redirect()->route('cart.cart');
    }
}
