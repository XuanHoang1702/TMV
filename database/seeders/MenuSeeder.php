<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('menus')->truncate();

        \DB::table('menus')->insert([
            ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => 'admin.dashboard', 'order' => 1, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Dịch vụ', 'icon' => 'fas fa-concierge-bell', 'route' => 'admin.services.index', 'order' => 2, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Tin tức', 'icon' => 'fas fa-newspaper', 'route' => 'admin.news.index', 'order' => 3, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Danh mục', 'icon' => 'fas fa-folder', 'route' => 'admin.categories.index', 'order' => 4, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Lịch hẹn', 'icon' => 'fas fa-calendar-check', 'route' => 'admin.appointments.index', 'order' => 5, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Liên hệ', 'icon' => 'fas fa-envelope', 'route' => 'admin.contacts.index', 'order' => 6, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Media', 'icon' => 'fas fa-images', 'route' => 'admin.media.index', 'order' => 7, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Người dùng', 'icon' => 'fas fa-users', 'route' => 'admin.users.index', 'order' => 8, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Cài đặt', 'icon' => 'fas fa-cog', 'route' => 'admin.settings.index', 'order' => 9, 'type' => 'admin', 'is_active' => true],
            ['label' => 'Trang chủ', 'icon' => null, 'route' => 'home', 'order' => 1, 'type' => 'frontend', 'is_active' => true],
            ['label' => 'Về Dr. Đạt', 'icon' => null, 'route' => 'about', 'order' => 2, 'type' => 'frontend', 'is_active' => true],
            ['label' => 'Báo giá', 'icon' => null, 'route' => 'pricing', 'order' => 3, 'type' => 'frontend', 'is_active' => true],
            ['label' => 'Liên hệ', 'icon' => null, 'route' => 'contact', 'order' => 4, 'type' => 'frontend', 'is_active' => true],
        ]);
    }
}
