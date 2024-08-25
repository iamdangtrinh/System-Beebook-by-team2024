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
        Schema::create('banner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('text_link')->nullable();
            $table->string('text_title')->nullable();
            $table->string('text_description')->nullable();
            $table->string('text_button')->nullable();
            $table->unsignedTinyInteger('order');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner');
    }
};
