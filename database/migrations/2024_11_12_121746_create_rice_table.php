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
        Schema::create('rice', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('per_sack');
            $table->integer('price_bought');
            $table->integer('quantity');
            $table->string('address');
            $table->string('quality');
            $table->string('dealer');
            $table->string('image_name');
            $table->integer('rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rice');
    }
};
