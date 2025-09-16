<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->insert([
            'title' => 'Nam Giới Và Phẫu Thuật Thẩm Mỹ: Khi Phái Mạnh Cũng Áp Lực Ngoại Hình',
            'slug' => Str::slug('Nam Giới Và Phẫu Thuật Thẩm Mỹ: Khi Phái Mạnh Cũng Áp Lực Ngoại Hình'),
            'summary' => 'Làm đàn ông phải mạnh mẽ, không quan trọng ngoại hình! Nhưng sự thật ngày nay là: nam giới cũng đang chịu những áp lực khủng khiếp về vẻ ngoài, thậm chí không kém gì phụ nữ.',
            'content' => '
        <p>"Làm đàn ông phải mạnh mẽ, không quan trọng ngoại hình!"Nhưng sự thật ngày nay là: nam giới cũng đang chịu những áp lực khủng khiếp về vẻ ngoài, thậm chí không kém gì phụ nữ.</p>
        <p>
            Xu hướng thẩm mỹ ở nam giới đang tăng mạnh
            Không còn là câu chuyện hiếm gặp, nam giới hiện đại ngày càng chủ động tìm đến các hình thức làm đẹp như:
        </p>
        <ul>
            <li>Cắt mí, nâng mũi</li>
            <li>Gọt hàm, hút mỡ mặt</li>
            <li>Làm răng sứ, cấy tóc</li>
            <li> Chăm sóc da chuyên sâu</li>
        </ul>
        <p>
            Theo nhiều thống kê, số lượng nam giới thẩm mỹ đã tăng 30 – 40% trong vài năm trở lại đây, đặc biệt ở độ tuổi từ 20 đến 35.
        </p>
        <center>
            <img src="../images/tintuc/news_details_01.png" />
        </center>
        <p>Áp lực đến từ đâu?</p>
        <ul class="ul-lst-num">
            <li>
                Công việc yêu cầu ngoại hình </br>
                Ngành nghề như nghệ thuật, kinh doanh, dịch vụ... đều ngày càng xem trọng ngoại hình. Một gương mặt sáng, dễ nhìn đôi khi mang đến cơ hội rõ rệt hơn.
            </li>
            <li>
                Truyền thông và mạng xã hội </br>
                Hình ảnh "soái ca", "nam thần", "body 6 múi" tràn ngập các nền tảng, khiến đàn ông cũng rơi vào cuộc đua làm đẹp không tên.
            </li>
            <li>
                So sánh và sự kỳ vọng </br>
                Khi phụ nữ ngày càng đẹp, chỉn chu, không ít nam giới cảm thấy áp lực phải “xứng tầm”. Ngoại hình giờ đây trở thành yếu tố để cạnh tranh, không chỉ là chuyện cá nhân.
            </li>
        </ul>
        <center>
            <img src="../images/tintuc/news_details_02.png" />
        </center>

        <p>
            Làm đẹp là quyền, không phân biệt giới tính
        </p>
        <p> Việc nam giới làm đẹp không có gì sai. Ngược lại, đó là dấu hiệu của sự quan tâm đến bản thân, của sự tiến bộ.</p>
        <p>Tuy nhiên, điều quan trọng là: </p>
        <ul>
            <li>Đừng vì chạy theo xu hướng mà đánh mất chính mình.</li>
            <li> Đừng vì lời chê bai mà tự phủ nhận giá trị vốn có.</li>
            <li>
                Và nếu bạn muốn chỉnh sửa điều gì – hãy chắc rằng đó là mong muốn xuất phát từ bên trong, không phải từ nỗi sợ bị so sánh.
            </li>
        </ul>

        <center>
            <img src="../images/tintuc/news_details_02.png" />
        </center>
        <p>Áp lực đến từ đâu?</p>
        <ul class="ul-lst-num">
            <li>
                Công việc yêu cầu ngoại hình<br />
                Ngành nghề như nghệ thuật, kinh doanh, dịch vụ... đều ngày càng xem trọng ngoại hình. Một gương mặt sáng, dễ nhìn đôi khi mang đến cơ hội rõ rệt hơn.
            </li>
            <li>
                Truyền thông và mạng xã hội<br />
                Hình ảnh "soái ca", "nam thần", "body 6 múi" tràn ngập các nền tảng, khiến đàn ông cũng rơi vào cuộc đua làm đẹp không tên.
            </li>
            <li>
                So sánh và sự kỳ vọng<br />
                Khi phụ nữ ngày càng đẹp, chỉn chu, không ít nam giới cảm thấy áp lực phải “xứng tầm”. Ngoại hình giờ đây trở thành yếu tố để cạnh tranh, không chỉ là chuyện cá nhân.
            </li>
        </ul>
',
            'category_id' => 1,
            'is_active' => true,
            'is_featured' => false,
            'published_at' => Carbon::create(2025, 3, 30, 18, 0, 0),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
