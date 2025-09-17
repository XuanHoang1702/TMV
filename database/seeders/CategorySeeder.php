<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();

        $categories = [
            'Phẫu thuật thẩm mỹ cô bé',
            'Phẫu thuật tạo hình thẩm mỹ ngực',
            'Phẫu thuật tạo hình thẩm mỹ mông',
            'Hút mỡ, cấy mỡ',
            'Phẫu thuật tạo hình thẩm mỹ mắt',
            'Phẫu thuật tạo hình thẩm mỹ mũi',
            'Phẫu thuật tạo hình thẩm mỹ vùng mặt',
            'Thẩm mỹ nội khoa',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name'       => $category,
                'slug'       => Str::slug($category, '-'),
                'parent_id'  => null, // nếu muốn có danh mục cha thì sửa ở đây
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
