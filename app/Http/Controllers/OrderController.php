<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function save()
    {
        try {
            DB::transaction(function () {
                $user = User::query()->create([
                    'name' => \request('user_name'),
                    'email' => \request('user_email'),
                    'password' => bcrypt(\request('user_email')),
                    // 'is_active' => false,
                ]);

                $totalAmount = 0;
                $dataItem = [];

                foreach (session('cart') as $variantID => $value) {
                    $totalAmount += $value['quantities'] * ($value['price_sale'] ?: $value['price_regular']);

                    $dataItem[] = [
                        'product_variant_id' => $variantID,
                        'product_quantity' => $value['quantities'],
                        'product_name' => $value['name'],
                        'product_sku' => $value['sku'],
                        'product_img_thumbnail' => $value['img_thumbnail'],
                        'product_price_regular' => $value['price_regular'],
                        'product_price_sale' => $value['price_sale'],
                        'variant_size_name' => $value['size']['name'],
                        'variant_color_name' => $value['color']['name'],
                    ];
                }

                $order = Order::query()->create([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_phone' => \request('user_phone'),
                    'user_address' => \request('user_address'),
                    'total_price' => $totalAmount,
                ]);
                foreach ($dataItem as $item) {
                    $item['order_id'] = $order->id;
                    OrderItem::query()->create($item);
                }
            });
            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Đặt hàng thành công');

        } catch (\Exception $exception) {

            dd($exception->getMessage());

            return back()->with('error', 'Lỗi đặt hàng không thành công');
        }
    }
}
