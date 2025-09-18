<?php
// database/migrations/xxxx_create_about_us_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // Phân loại nội dung
            $table->string('section_type')->comment('Loại section: hero, pillars, service_intro, commitments, banner');
            $table->string('page_type')->default('about')->comment('about, services, contact');

            // Dữ liệu chính (tùy theo section_type)
            $table->string('title')->nullable()->comment('Title cho hero/service_intro');
            $table->text('description')->nullable()->comment('Description cho hero/service_intro');
            $table->string('subtitle')->nullable()->comment('Subtitle cho commitments');

            // Dữ liệu linh hoạt dạng JSON
            $table->json('content_data')->nullable()->comment('Dữ liệu items cho pillars/commitments');
            $table->json('banner_data')->nullable()->comment('Dữ liệu banners cho section banner');

            // Cấu hình hiển thị
            $table->json('display_config')->nullable()->comment('{"layout": "horizontal", "columns": 3, "animation": "flip-right"}');

            // Thứ tự & trạng thái
            $table->integer('order')->default(1);
            $table->boolean('is_active')->default(true);

            // Timestamps
            $table->timestamps();

            // Index
            $table->index(['page_type', 'section_type', 'order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_us');
    }
}
