<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\ProductVariant::class)->constrained();

            $table ->string('name');
            $table ->string('email');
            $table ->string('phone');
            $table ->string('address');
            $table ->string('note');

            $table ->boolean('is_ship_user_same_user')->default(true);


            $table ->string('name')->nullable();
            $table ->string('email')->nullable();
            $table ->string('phone')->nullable();
            $table ->string('address')->nullable();
            $table ->string('note')->nullable();


            $table ->string('status_order')->default(\App\Models\Order::STATUS_ORDER_PENDING);
            $table ->string('status_payment')->default(\App\Models\Order::STARTUS_PAYMENT_UNPAID);

            $table->double('total_price' , 15 , 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
