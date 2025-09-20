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
        Schema::table('zalo_settings', function (Blueprint $table) {
            $table->string('messenger_contact')->nullable()->after('zalo_type');
            $table->string('messenger_type')->default('facebook')->after('messenger_contact');
            $table->string('messenger_icon')->default('fab fa-facebook-messenger')->after('messenger_type');
            $table->string('call_contact')->nullable()->after('messenger_icon');
            $table->string('call_type')->default('phone')->after('call_contact');
            $table->string('call_icon')->default('fas fa-phone')->after('call_type');
            $table->string('zalo_icon')->default('fas fa-comment')->after('zalo_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zalo_settings', function (Blueprint $table) {
            $table->dropColumn(['messenger_contact', 'messenger_type', 'messenger_icon', 'call_contact', 'call_type', 'call_icon', 'zalo_icon']);
        });
    }
};
