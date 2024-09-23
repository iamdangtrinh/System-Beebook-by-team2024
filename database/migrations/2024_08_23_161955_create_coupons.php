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
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_coupon', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->decimal('coupon_min_spend', 15,0);
            $table->decimal('coupon_max_spend', 15,0);
            $table->decimal('discount', 15,0);
            $table->enum('type_coupon', ['percent', 'amount']);
            $table->integer('quantity')->comment("Số lần tối đa sử dụng coupon đó");
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
