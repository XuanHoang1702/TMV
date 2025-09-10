<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main service categories
        $serviceCategories = [
            [
                'name' => 'Phẫu thuật thẩm mỹ',
                'slug' => 'phau-thuat-tham-my',
                'description' => 'Các dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp',
                'type' => 'service',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Điều trị da',
                'slug' => 'dieu-tri-da',
                'description' => 'Các phương pháp điều trị da chuyên sâu',
                'type' => 'service',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Tiêm filler',
                'slug' => 'tiem-filler',
                'description' => 'Dịch vụ tiêm filler làm đầy nếp nhăn',
                'type' => 'service',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Tiêm Botox',
                'slug' => 'tiem-botox',
                'description' => 'Dịch vụ tiêm Botox trẻ hóa da',
                'type' => 'service',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        // News categories
        $newsCategories = [
            [
                'name' => 'Chuyên môn',
                'slug' => 'chuyen-mon',
                'description' => 'Bài viết về kỹ thuật và chuyên môn',
                'type' => 'news',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Báo chí & Truyền thông',
                'slug' => 'bao-chi-truyen-thong',
                'description' => 'Tin tức và hoạt động của phòng khám',
                'type' => 'news',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Đào tạo',
                'slug' => 'dao-tao',
                'description' => 'Các chương trình đào tạo và hội thảo',
                'type' => 'news',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Từ thiện',
                'slug' => 'tu-thien',
                'description' => 'Hoạt động từ thiện và trách nhiệm xã hội',
                'type' => 'news',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        // Create service categories
        foreach ($serviceCategories as $category) {
            Category::create($category);
        }

        // Create news categories
        foreach ($newsCategories as $category) {
            Category::create($category);
        }

        // Create subcategories for services
        $eyeSurgery = Category::where('slug', 'phau-thuat-tham-my')->first();
        if ($eyeSurgery) {
            $eyeSubcategories = [
                [
                    'name' => 'Phẫu thuật mắt',
                    'slug' => 'phau-thuat-mat',
                    'description' => 'Cắt mí mắt, nâng mí mắt',
                    'parent_id' => $eyeSurgery->id,
                    'type' => 'service',
                    'order' => 1,
                    'is_active' => true,
                ],
                [
                    'name' => 'Phẫu thuật mũi',
                    'slug' => 'phau-thuat-mui',
                    'description' => 'Nâng mũi, chỉnh hình mũi',
                    'parent_id' => $eyeSurgery->id,
                    'type' => 'service',
                    'order' => 2,
                    'is_active' => true,
                ],
                [
                    'name' => 'Phẫu thuật ngực',
                    'slug' => 'phau-thuat-nguc',
                    'description' => 'Tăng ngực, thu nhỏ ngực',
                    'parent_id' => $eyeSurgery->id,
                    'type' => 'service',
                    'order' => 3,
                    'is_active' => true,
                ],
            ];

            foreach ($eyeSubcategories as $subcategory) {
                Category::create($subcategory);
            }
        }
    }
}
