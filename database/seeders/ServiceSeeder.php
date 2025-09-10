<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Dịch Vụ Thẩm Mỹ Cô Bé',
                'slug' => 'dich-vu-tham-my-co-be',
                'description' => 'Phẫu thuật thẩm mỹ cô bé là dịch vụ làm đẹp vùng kín giúp khôi phục sự tự tin và cải thiện sức khỏe sinh lý cho phái nữ.',
                'content' => '<p>Phẫu thuật thẩm mỹ cô bé bao gồm các dịch vụ:</p>
                <ul>
                    <li>Thu hẹp âm đạo</li>
                    <li>Tạo hình môi âm đạo</li>
                    <li>Tạo hình màng trinh</li>
                    <li>Nâng cơ vùng kín</li>
                    <li>Làm hồng vùng kín</li>
                </ul>
                <p>Tất cả các dịch vụ đều được thực hiện bởi đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm với công nghệ hiện đại.</p>',
                'image' => 'images/services/tham-my-co-be.jpg',
                'icon' => 'images/icons/icon_cate1.png',
                'price_range' => '30.000.000 - 50.000.000 VND',
                'duration' => '1-2 giờ',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Dịch Vụ Thẩm Mỹ Cô Bé - Dr. Đạt',
                'meta_description' => 'Dịch vụ phẫu thuật thẩm mỹ cô bé chuyên nghiệp tại phòng khám Dr. Đạt. An toàn, hiệu quả với đội ngũ bác sĩ giàu kinh nghiệm.',
            ],
            [
                'name' => 'Dịch Vụ Phẫu Thuật Tạo Hình Thẩm Mỹ Ngực',
                'slug' => 'dich-vu-phau-thuat-tao-hinh-tham-my-nguc',
                'description' => 'Phẫu thuật tạo hình thẩm mỹ ngực giúp cải thiện hình dáng và kích thước ngực tự nhiên.',
                'content' => '<p>Dịch vụ phẫu thuật ngực bao gồm:</p>
                <ul>
                    <li>Tăng ngực</li>
                    <li>Thu nhỏ ngực</li>
                    <li>Nâng ngực</li>
                    <li>Chỉnh hình ngực</li>
                </ul>
                <p>Sử dụng công nghệ tiên tiến và vật liệu an toàn, đảm bảo kết quả tự nhiên và lâu dài.</p>',
                'image' => 'images/services/tham-my-nguc.jpg',
                'icon' => 'images/icons/icon_cate2.png',
                'price_range' => '50.000.000 - 120.000.000 VND',
                'duration' => '2-3 giờ',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'Phẫu Thuật Tạo Hình Thẩm Mỹ Ngực - Dr. Đạt',
                'meta_description' => 'Dịch vụ phẫu thuật ngực chuyên nghiệp tại phòng khám Dr. Đạt. Tăng ngực, thu nhỏ ngực với công nghệ hiện đại.',
            ],
            [
                'name' => 'Dịch Vụ Phẫu Thuật Tạo Hình Thẩm Mỹ Mông',
                'slug' => 'dich-vu-phau-thuat-tao-hinh-tham-my-mong',
                'description' => 'Phẫu thuật tạo hình thẩm mỹ mông giúp cải thiện hình dáng và kích thước mông tự nhiên.',
                'content' => '<p>Dịch vụ phẫu thuật mông bao gồm:</p>
                <ul>
                    <li>Tăng kích thước mông</li>
                    <li>Nâng mông</li>
                    <li>Chỉnh hình mông</li>
                    <li>Cấy mỡ mông</li>
                </ul>
                <p>Đảm bảo kết quả tự nhiên, hài hòa với tổng thể cơ thể.</p>',
                'image' => 'images/services/tham-my-mong.jpg',
                'icon' => 'images/icons/icon_cate3.png',
                'price_range' => '40.000.000 - 80.000.000 VND',
                'duration' => '2-3 giờ',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 3,
                'meta_title' => 'Phẫu Thuật Tạo Hình Thẩm Mỹ Mông - Dr. Đạt',
                'meta_description' => 'Dịch vụ phẫu thuật mông chuyên nghiệp tại phòng khám Dr. Đạt. Tăng kích thước mông tự nhiên.',
            ],
            [
                'name' => 'Hút Mỡ, Cấy Mỡ',
                'slug' => 'hut-mo-cay-mo',
                'description' => 'Dịch vụ hút mỡ và cấy mỡ giúp định hình cơ thể, loại bỏ mỡ thừa và tạo đường cong hoàn hảo.',
                'content' => '<p>Dịch vụ hút mỡ, cấy mỡ bao gồm:</p>
                <ul>
                    <li>Hút mỡ bụng</li>
                    <li>Hút mỡ đùi</li>
                    <li>Hút mỡ lưng</li>
                    <li>Cấy mỡ mặt</li>
                    <li>Cấy mỡ mông</li>
                </ul>
                <p>Sử dụng công nghệ hút mỡ hiện đại, an toàn và hiệu quả cao.</p>',
                'image' => 'images/services/hut-mo-cay-mo.jpg',
                'icon' => 'images/icons/icon_cate4.png',
                'price_range' => '25.000.000 - 60.000.000 VND',
                'duration' => '1-3 giờ',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 4,
                'meta_title' => 'Hút Mỡ Cấy Mỡ - Dr. Đạt',
                'meta_description' => 'Dịch vụ hút mỡ cấy mỡ chuyên nghiệp tại phòng khám Dr. Đạt. Định hình cơ thể hoàn hảo.',
            ],
            [
                'name' => 'Dịch Vụ Phẫu Thuật Tạo Hình Thẩm Mỹ Mắt',
                'slug' => 'dich-vu-phau-thuat-tao-hinh-tham-my-mat',
                'description' => 'Phẫu thuật tạo hình thẩm mỹ mắt giúp cải thiện hình dáng đôi mắt, tạo vẻ đẹp tự nhiên và quyến rũ.',
                'content' => '<p>Dịch vụ phẫu thuật mắt bao gồm:</p>
                <ul>
                    <li>Cắt mí mắt</li>
                    <li>Nâng mí mắt</li>
                    <li>Mở rộng góc mắt</li>
                    <li>Chỉnh hình mí mắt</li>
                </ul>
                <p>Đội ngũ bác sĩ chuyên khoa với kinh nghiệm dày dặn đảm bảo kết quả an toàn và tự nhiên.</p>',
                'image' => 'images/services/tham-my-mat.jpg',
                'icon' => 'images/icons/icon_cate5.png',
                'price_range' => '15.000.000 - 35.000.000 VND',
                'duration' => '30-60 phút',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 5,
                'meta_title' => 'Phẫu Thuật Tạo Hình Thẩm Mỹ Mắt - Dr. Đạt',
                'meta_description' => 'Dịch vụ phẫu thuật mắt chuyên nghiệp tại phòng khám Dr. Đạt. Cắt mí mắt, nâng mí mắt tự nhiên.',
            ],
            [
                'name' => 'Dịch Vụ Phẫu Thuật Tạo Hình Thẩm Mỹ Mũi',
                'slug' => 'dich-vu-phau-thuat-tao-hinh-tham-my-mui',
                'description' => 'Phẫu thuật tạo hình thẩm mỹ mũi giúp cải thiện hình dáng mũi, tạo sự hài hòa cho khuôn mặt.',
                'content' => '<p>Dịch vụ phẫu thuật mũi bao gồm:</p>
                <ul>
                    <li>Nâng mũi</li>
                    <li>Chỉnh hình mũi</li>
                    <li>Thu gọn cánh mũi</li>
                    <li>Sửa mũi</li>
                </ul>
                <p>Sử dụng sụn tự thân và công nghệ hiện đại đảm bảo an toàn và kết quả lâu dài.</p>',
                'image' => 'images/services/tham-my-mui.jpg',
                'icon' => 'images/icons/icon_cate6.png',
                'price_range' => '25.000.000 - 70.000.000 VND',
                'duration' => '1-2 giờ',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 6,
                'meta_title' => 'Phẫu Thuật Tạo Hình Thẩm Mỹ Mũi - Dr. Đạt',
                'meta_description' => 'Dịch vụ phẫu thuật mũi chuyên nghiệp tại phòng khám Dr. Đạt. Nâng mũi tự nhiên, an toàn.',
            ],
            [
                'name' => 'Dịch Vụ Phẫu Thuật Tạo Hình Thẩm Mỹ Vùng Mặt',
                'slug' => 'dich-vu-phau-thuat-tao-hinh-tham-my-vung-mat',
                'description' => 'Phẫu thuật tạo hình thẩm mỹ vùng mặt giúp cải thiện các khuyết điểm và tạo vẻ đẹp hoàn hảo.',
                'content' => '<p>Dịch vụ phẫu thuật mặt bao gồm:</p>
                <ul>
                    <li>Cắt da thừa mặt</li>
                    <li>Nâng cung mày</li>
                    <li>Chỉnh hình cằm</li>
                    <li>Thu gọn hàm</li>
                </ul>
                <p>Đội ngũ bác sĩ chuyên khoa với công nghệ tiên tiến đảm bảo kết quả an toàn và tự nhiên.</p>',
                'image' => 'images/services/tham-my-mat.jpg',
                'icon' => 'images/icons/icon_cate7.png',
                'price_range' => '20.000.000 - 50.000.000 VND',
                'duration' => '1-3 giờ',
                'category' => 'Phẫu thuật thẩm mỹ',
                'is_active' => true,
                'sort_order' => 7,
                'meta_title' => 'Phẫu Thuật Tạo Hình Thẩm Mỹ Vùng Mặt - Dr. Đạt',
                'meta_description' => 'Dịch vụ phẫu thuật mặt chuyên nghiệp tại phòng khám Dr. Đạt. Cải thiện khuyết điểm khuôn mặt.',
            ],
            [
                'name' => 'Thẩm Mỹ Nội Khoa',
                'slug' => 'tham-my-noi-khoa',
                'description' => 'Dịch vụ thẩm mỹ nội khoa sử dụng công nghệ tiên tiến không phẫu thuật để làm đẹp da và trẻ hóa.',
                'content' => '<p>Dịch vụ thẩm mỹ nội khoa bao gồm:</p>
                <ul>
                    <li>Tiêm filler</li>
                    <li>Tiêm Botox</li>
                    <li>Trẻ hóa da laser</li>
                    <li>Điều trị nám, tàn nhang</li>
                </ul>
                <p>Công nghệ hiện đại, an toàn, không cần nghỉ dưỡng, mang lại hiệu quả tức thì.</p>',
                'image' => 'images/services/tham-my-noi-khoa.jpg',
                'icon' => 'images/icons/icon_cate8.png',
                'price_range' => '5.000.000 - 25.000.000 VND',
                'duration' => '30-60 phút',
                'category' => 'Thẩm mỹ nội khoa',
                'is_active' => true,
                'sort_order' => 8,
                'meta_title' => 'Thẩm Mỹ Nội Khoa - Dr. Đạt',
                'meta_description' => 'Dịch vụ thẩm mỹ nội khoa không phẫu thuật tại phòng khám Dr. Đạt. Tiêm filler, Botox, trẻ hóa da.',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
