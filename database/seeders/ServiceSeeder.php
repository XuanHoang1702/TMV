<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->truncate();

        // giả sử category_id = "co-be" (danh mục Phẫu thuật thẩm mỹ cô bé)
        $categoryId = 'co-be';

        $services = [
            [
                'name'        => 'Thu Hẹp Âm Đạo',
                'description' => 'Phẫu thuật thu hẹp âm đạo giúp cải thiện độ săn chắc và co giãn của vùng kín, phục hồi khả năng đàn hồi sau sinh nở hoặc do tuổi tác. Đây là phương pháp giúp tăng cường khoái cảm tình dục và cải thiện chất lượng đời sống vợ chồng.',
                'icon_page_service' => 'images/dichvu/icon_dv1.png',
                'image'       => 'images/dichvu/dv_01.png',
            ],
            [
                'name'        => 'Tạo Hình Môi Âm Đạo',
                'description' => 'Dịch vụ này giúp chỉnh sửa kích thước và hình dáng của môi lớn và môi nhỏ, mang lại vẻ đẹp tự nhiên, hài hòa cho vùng kín. Đặc biệt, phẫu thuật này còn giúp giảm sự khó chịu do môi âm đạo bị thừa hay không đều.',
                'icon_page_service' => 'images/dichvu/icon_dv2.png',
                'image'       => 'images/dichvu/dv_01.png',
            ],
            [
                'name'        => 'Tạo Hình Màng Trinh',
                'description' => 'Phẫu thuật tái tạo màng trinh, giúp phục hồi sự nguyên vẹn cho những chị em mong muốn có lại cảm giác như thuở ban đầu.',
                'icon_page_service' => 'images/dichvu/icon_dv3.png',
                'image'       => 'images/dichvu/dv_01.png',
            ],
            [
                'name'        => 'Nâng Cơ Vùng Kín',
                'description' => 'Cải thiện độ săn chắc của cơ vùng âm đạo giúp phụ nữ trẻ trung hơn và tự tin hơn trong đời sống tình dục. Phương pháp này cũng có thể hỗ trợ trong việc khắc phục hiện tượng tiểu són sau sinh.',
                'icon_page_service' => 'images/dichvu/icon_dv4.png',
                'image'       => 'images/dichvu/dv_01.png',
            ],
            [
                'name'        => 'Làm Hồng Vùng Kín',
                'description' => 'Dịch vụ làm hồng vùng kín giúp làm sáng và đều màu da vùng kín, mang lại vẻ đẹp tự nhiên và tăng thêm sự tự tin cho phái nữ. Phương pháp này sử dụng công nghệ hiện đại và an toàn, giúp cải thiện sắc tố da, đem lại làn da mịn màng, hồng hào.',
                'icon_page_service' => 'images/dichvu/icon_dv5.png',
                'image'       => 'images/dichvu/dv_01.png',
            ],
        ];

        foreach ($services as $service) {
            DB::table('services')->insert([
                'name'        => $service['name'],
                'slug'        => Str::slug($service['name']),
                'description' => $service['description'],
                'content'     => null,
                'image'       => $service['image'],
                'icon_page_home' => null,
                'icon_page_service' => $service['icon_page_service'],
                'price_range' => null,
                'duration'    => null,
                'category_id' => $categoryId,
                'parent_id'   => null,
                'is_active'   => true,
                'sort_order'  => 0,
                'meta_title'  => $service['name'],
                'meta_description' => $service['description'],
                'allow_line_breaks' => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
