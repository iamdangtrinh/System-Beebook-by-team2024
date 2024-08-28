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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_wallet');
            $table->decimal('amount', 15, 0);
            $table->enum('type', ['in', 'out']);
            $table->string('status'); // thành công hoặc thất bại
            $table->string('method');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('id_wallet')->references('id')->on('wallets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
