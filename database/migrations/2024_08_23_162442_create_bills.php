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
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_coupon');
            $table->enum('status', ['new', 'shipping', 'success', 'cancel', 'refund'])->default('new');
            $table->string('reason_cancel')->nullable();
            $table->decimal('total_amount', 15, 0);
            $table->string('payment_method');
            $table->enum('payment_status', ['PAID', 'UNPAID'])->default('UNPAID'); // PAID / UNPAID
            $table->string('shipping_method');
            $table->decimal('fee_shipping', 15, 0)->nullable();
            $table->decimal('discount', 15, 0)->nullable();
            $table->string('address', 255);
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->text('note')->nullable();
            $table->text('note_admin')->nullable();
            $table->timestamps();

            $table->foreign('id_coupon')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
