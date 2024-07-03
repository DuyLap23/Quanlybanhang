<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STARTUS_ORDER =   [
        'pending' => 'Chờ xác nhận',
        'comfirmed' => 'Đã xác nhận',
        'preparing' => 'Đang chuẩn bị hàng ',
        'shipping' => 'Đang vận chuyển',
        'delevered' => 'Đã giao hàng',
        'cancel' => 'Đã hủy'
    ];
    const STARTUS_PAYMENT =   [
        'unpaid' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán',
    ];
    const STATUS_ORDER_PENDING = 'pending';
    const STATUS_ORDER_CONFIRMED = 'comfirmed';
    const STATUS_ORDER_PREPARING = 'preparing';
    const STATUS_ORDER_SHIPPING = 'shipping';
    const STATUS_ORDER_DELEVERED = 'delevered';
    const STATUS_ORDER_CANCEL = 'cancel';
    const STARTUS_PAYMENT_UNPAID = 'unpaid';
    const STARTUS_PAYMENT_PAID = 'paid';
}
