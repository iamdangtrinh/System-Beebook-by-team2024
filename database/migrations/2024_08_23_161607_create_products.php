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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_category');
            $table->string('name');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->unsignedInteger('quantity')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('url_video', 50)->nullable();
            $table->string('image_cover', 100)->nullable(); // hình ảnh sản phẩm;
            $table->unsignedInteger('views')->default(0);
            $table->decimal('price', 15, 0);
            $table->decimal('price_sale', 15, 0)->nullable();
            $table->boolean('hot')->default(false);
            $table->string('meta_seo')->nullable();
            $table->text('description_seo')->nullable();

            $table->integer('year')->nullable();
            $table->integer('weight')->nullable();
            $table->string('language', 50)->nullable();

            $table->timestamps();
            $table->softDeletes(); // for deleted_at

            // Define foreign keys if applicable
            $table->foreign('id_category')->references('id')->on('categories_product')->onDelete('cascade');

            $table->unsignedBigInteger('id_author')->nullable();
            $table->unsignedBigInteger('id_translator')->nullable();
            $table->unsignedBigInteger('id_manufacturer')->nullable();

            // Add foreign key constraints
            $table->foreign('id_author')
                ->references('id')
                ->on('taxonomy')
                ->onDelete('set null');

            $table->foreign('id_translator')
                ->references('id')
                ->on('taxonomy')
                ->onDelete('set null');

            $table->foreign('id_manufacturer')
                ->references('id')
                ->on('taxonomy')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
