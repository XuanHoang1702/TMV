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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->default(0); // Thứ tự
            $table->string('title');                   // Tiêu đề
            
            $table->string('page')->nullable();        // Thuộc trang nào (vd: services, news...)
            $table->integer('section')->default(1);    // Khu vực hiển thị
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
