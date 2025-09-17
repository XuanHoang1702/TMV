<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('appointments')->truncate();

        DB::table('appointments')->insert([
            [
                'customer_name' => 'Nguyen Van A',
                'customer_phone' => '0123456789',
                'customer_email' => 'nguyenvana@example.com',
                'service_interest' => 'Dịch vụ 1',
                'appointment_date' => '2025-10-01',
                'appointment_time' => '10:00:00',
                'estimated_price' => '1000000',
                'notes' => 'Yêu cầu đặc biệt',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Tran Thi B',
                'customer_phone' => '0987654321',
                'customer_email' => 'tranthib@example.com',
                'service_interest' => 'Dịch vụ 2',
                'appointment_date' => '2025-10-02',
                'appointment_time' => '14:00:00',
                'estimated_price' => '2000000',
                'notes' => null,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
