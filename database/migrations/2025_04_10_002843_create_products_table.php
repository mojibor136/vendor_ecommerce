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
            $table->id();
            $table->string('product_name');
            $table->text('product_desc')->nullable();
            $table->decimal('product_price', 10, 2);
            $table->integer('product_quantity');
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->string('product_size')->nullable();
            $table->string('product_image')->nullable();
            $table->string('multiple_image')->nullable();
            $table->string('product_status')->nullable();
            $table->integer('rating')->default(0);
            $table->string('meta_tag')->nullable();
            $table->string('role')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('click_count');
            $table->integer('order_count');
            $table->timestamps();
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
