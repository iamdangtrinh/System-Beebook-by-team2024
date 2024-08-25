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
        Schema::create('post_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_product');
            $table->timestamps();

            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_product');
    }
};
