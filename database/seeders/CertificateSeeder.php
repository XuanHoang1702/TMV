<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::create([
            'title' => 'Chứng Chỉ Hành Nghề',
            'image_path' => 'images/home/h_image_sec3_4.png',
            'description' => 'Thẩm Mỹ Tận Tâm Dr. Đạt là đội ngũ bác sĩ PTTHTM có chuyên môn vững vàng với chứng chỉ hành nghề chuyên khoa được cấp phép bởi Sở Y Tế TP. HCM. Tất cả các quy trình thẩm mỹ đều được thực hiện bởi các bác sĩ, bác sĩ trực tiếp thăm khám, đảm bảo khách hàng sẽ nhận được sự chăm sóc tận tình và chuyên nghiệp nhất.',
            'order' => 1,
        ]);

        Certificate::create([
            'title' => 'Cơ Sở Vật Chất',
            'image_path' => 'images/home/h_image_sec3_3.png',
            'description' => 'Cơ sở vật chất hiện đại, trang bị đầy đủ thiết bị y tế tiên tiến, phòng khám đạt chuẩn vệ sinh an toàn.',
            'order' => 2,
        ]);

        Certificate::create([
            'title' => 'Chất Lượng Dịch Vụ',
            'image_path' => 'images/home/h_image_sec3_4.png',
            'description' => 'Cam kết chất lượng dịch vụ cao nhất, tư vấn chuyên nghiệp, chăm sóc tận tâm.',
            'order' => 3,
        ]);

        Certificate::create([
            'title' => 'Quy Trình Thăm Khám',
            'image_path' => 'images/home/h_image_sec3_3.png',
            'description' => 'Quy trình thăm khám khoa học, an toàn, hiệu quả, được thực hiện bởi đội ngũ bác sĩ chuyên nghiệp.',
            'order' => 4,
        ]);
    }
}
