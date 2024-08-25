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
            $table->timestamps();
            $table->timestamp('expires_at')->nullable();
            $table->decimal('discount', 15, 2);
            $table->tinyInteger('type_coupon');
            $table->integer('quantity');
            $table->tinyInteger('status');
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
