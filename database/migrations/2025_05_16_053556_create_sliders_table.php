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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('images'); 
            $table->string('type'); 
            $table->string('link')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->string('author_type');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->index(['author_id', 'author_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
