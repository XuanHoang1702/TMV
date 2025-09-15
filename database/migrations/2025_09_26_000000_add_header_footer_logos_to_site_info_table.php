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
        Schema::table('site_info', function (Blueprint $table) {
            $table->string('header_logo')->nullable()->after('logo');
            $table->string('footer_logo')->nullable()->after('header_logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_info', function (Blueprint $table) {
            $table->dropColumn(['header_logo', 'footer_logo']);
        });
    }
};
