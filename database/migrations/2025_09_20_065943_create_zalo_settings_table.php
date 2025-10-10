<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('zalo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('zalo_contact')->unique()->comment('Zalo OA ID hoặc số điện thoại');
            $table->string('zalo_type')->default('phone')->comment('Loại: oa hoặc phone');
              $table->string('messenger_contact')->nullable()->after('zalo_type');
            $table->string('messenger_type')->default('facebook')->after('messenger_contact');
            $table->string('messenger_icon')->default('fab fa-facebook-messenger')->after('messenger_type');
            $table->string('call_contact')->nullable()->after('messenger_icon');
            $table->string('call_type')->default('phone')->after('call_contact');
            $table->string('call_icon')->default('fas fa-phone')->after('call_type');
            $table->string('zalo_icon')->default('fas fa-comment')->after('zalo_type');
            $table->timestamps();
        });

        // Insert default value
        DB::table('zalo_settings')->insert([
            'zalo_contact' => '0123456789', // Default số điện thoại
            'zalo_type' => 'phone',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('zalo_settings');
    }
};
