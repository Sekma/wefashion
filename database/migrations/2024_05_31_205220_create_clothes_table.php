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
        Schema::create('clothes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference', length: 100);
            $table->string('name', length: 100);
            $table->text('description')->nullable();
            $table->float('price');
            $table->enum('status', ['standard', 'sale']);
            $table->enum('visibility', ['published', 'unpublished']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothes');
    }
};
