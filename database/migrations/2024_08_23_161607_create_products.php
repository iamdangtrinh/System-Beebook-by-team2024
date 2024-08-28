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
            $table->unsignedBigInteger('id_image')->nullable();
            $table->unsignedBigInteger('id_category');
            $table->string('name', 50);
            $table->longText('description');
            $table->string('slug', 80)->unique();
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedInteger('quantity')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('url_video')->nullable();
            $table->string('image_cover')->nullable(); // hình ảnh sản phẩm;
            $table->unsignedInteger('views')->default(0);
            $table->decimal('price', 15, 0);
            $table->decimal('price_sale', 15, 0)->nullable();
            $table->boolean('hot')->default(false);
            $table->date('start_sale')->nullable();
            $table->date('end_sale')->nullable();
            $table->string('meta_seo')->nullable();
            $table->text('description_seo')->nullable();
            $table->timestamps();
            $table->softDeletes(); // for deleted_at

            // Define foreign keys if applicable
            $table->foreign('id_category')->references('id')->on('categories_product')->onDelete('cascade');
            $table->foreign('id_image')->references('id')->on('product_image')->onDelete('set null');
            
            $table->unsignedBigInteger('author')->nullable();
            $table->unsignedBigInteger('publisher')->nullable();
            $table->unsignedBigInteger('manufacturer')->nullable();

            // Add foreign key constraints
            $table->foreign('author')
                ->references('id')
                ->on('taxonomy')
                ->onDelete('set null');

            $table->foreign('publisher')
                ->references('id')
                ->on('taxonomy')
                ->onDelete('set null');

            $table->foreign('manufacturer')
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
