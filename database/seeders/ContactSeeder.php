<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->truncate();

        DB::table('contacts')->insert([
            [
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@example.com',
                'phone' => '0123456789',
                'subject' => 'Yêu cầu tư vấn',
                'message' => 'Tôi muốn biết thêm về dịch vụ.',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tran Thi B',
                'email' => 'tranthib@example.com',
                'phone' => '0987654321',
                'subject' => 'Đặt lịch hẹn',
                'message' => 'Tôi muốn đặt lịch hẹn vào tuần tới.',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
