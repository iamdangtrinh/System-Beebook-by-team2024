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
            $table->string('phone', 100)->nullable();
            $table->enum('roles', ['admin', 'customer'])->default('customer');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('avatar', 100)->nullable();
            // $table->string('facebook_id', 50)->nullable();
            $table->string('google_id', 50)->nullable();
            // $table->unsignedBigInteger('id_city')->nullable();
            // $table->unsignedBigInteger('id_province')->nullable();
            // $table->unsignedBigInteger('id_ward')->nullable();
            $table->string('address', 255)->nullable();
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
