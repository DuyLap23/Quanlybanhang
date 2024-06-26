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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Product::class)->constrained();
            $table->foreignIdFor(App\Models\ProductSize::class)->constrained();
            $table->foreignIdFor(App\Models\ProductColor::class)->constrained();
            $table->unsignedInteger('quantity')->nullable(0);
            $table->string('image')->nullable();
            $table->unique(['product_id', 'product_size_id', 'product_color_id'], 'product_variants_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
