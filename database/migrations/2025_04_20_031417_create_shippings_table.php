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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unique();
            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->text('shipping_address');
            $table->integer('shipping_country_id');
            $table->integer('shipping_district_id')->nullable();
            $table->integer('shipping_division_id');
            $table->string('shipping_phone');
            $table->string('shipping_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
