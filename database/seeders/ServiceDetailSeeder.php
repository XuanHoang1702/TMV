<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDetailSeeder extends Seeder
{
    public function run()
    {
        DB::table('service_details')->truncate();

        DB::table('service_details')->insert([
            [
                'service_id' => 1,
                'title' => 'Chi tiết dịch vụ 1',
                'description' => 'Mô tả chi tiết cho dịch vụ 1.',
                'image' => 'service_detail_1.jpg',
                'icon' => 'fas fa-star',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => 1,
                'title' => 'Chi tiết dịch vụ 2',
                'description' => 'Mô tả chi tiết cho dịch vụ 2.',
                'image' => 'service_detail_2.jpg',
                'icon' => 'fas fa-heart',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
