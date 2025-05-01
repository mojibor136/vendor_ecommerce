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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id'); 
            $table->integer('customer_id');
            $table->string('role')->nullable(); 
            $table->decimal('total_price', 10, 2);
            $table->string('order_status')->default('pending');
            $table->string('payment_method');
            $table->string('payment_status')->default('unpaid');
            $table->string('courier_name')->nullable(); 
            $table->boolean('is_manual_tracking')->default(false);
            $table->decimal('shipping_charge', 10, 2)->default(0);
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
