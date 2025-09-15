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
        Schema::table('services', function (Blueprint $table) {
            // Đổi tên cột icon -> icon_page_home
            if (Schema::hasColumn('services', 'icon')) {
                $table->renameColumn('icon', 'icon_page_home');
            }

            // Thêm cột icon_page_service
            if (!Schema::hasColumn('services', 'icon_page_service')) {
                $table->string('icon_page_service')->nullable()->after('icon_page_home');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Đổi lại tên icon_page_home -> icon
            if (Schema::hasColumn('services', 'icon_page_home')) {
                $table->renameColumn('icon_page_home', 'icon');
            }

            // Xóa cột icon_page_service
            if (Schema::hasColumn('services', 'icon_page_service')) {
                $table->dropColumn('icon_page_service');
            }
        });
    }
};
