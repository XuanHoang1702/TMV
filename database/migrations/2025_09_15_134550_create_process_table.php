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
        Schema::create('process', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('image');
            $table->string('title');
            $table->string('content');
            $table->string('page');
            $table->integer('section');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process');
    }
};
