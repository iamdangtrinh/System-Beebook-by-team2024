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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('post_type', ['review', 'blog']);
            $table->string('title', 50);
            $table->longText('content');
            $table->unsignedInteger('views')->default(0);
            $table->string('tags')->nullable();
            $table->string('image', 100)->nullable();
            $table->string('slug', 50)->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->tinyInteger('hot')->default(0);
            $table->string('meta_title_seo', 100)->nullable();
            $table->string('meta_description_seo', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
