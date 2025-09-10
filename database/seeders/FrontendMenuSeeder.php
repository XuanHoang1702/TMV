<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class FrontendMenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'label' => 'Trang chủ',
                'route' => 'home',
                'type' => 'frontend',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Về Dr. Đạt',
                'route' => 'about',
                'type' => 'frontend',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Báo giá',
                'route' => 'pricing',
                'type' => 'frontend',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Liên hệ',
                'route' => 'contact',
                'type' => 'frontend',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
