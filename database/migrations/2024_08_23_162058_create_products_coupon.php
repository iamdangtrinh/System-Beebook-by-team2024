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
        Schema::create('products_coupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_coupon');
            $table->unsignedBigInteger('id_product');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->foreign('id_coupon')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_coupon');
    }
};
