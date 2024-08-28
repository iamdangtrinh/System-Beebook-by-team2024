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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 10)->nullable();
            $table->enum('roles', ['admin', 'store', 'customer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('image', 100)->nullable();
            $table->string('facebook_id', 50)->nullable();
            $table->string('google_id', 50)->nullable();
            // $table->unsignedBigInteger('city_id')->nullable();
            // $table->unsignedBigInteger('province_id')->nullable();
            // $table->unsignedBigInteger('ward_id')->nullable();
            $table->string('address', 255);
            $table->date('birthday')->nullable();

            // $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            // $table->foreign('province_id')->references('id')->on('provinces')->onDelete('set null');
            // $table->foreign('ward_id')->references('id')->on('wards')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
