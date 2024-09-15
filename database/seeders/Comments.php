<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Comments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Giả sử bạn có 50 sản phẩm và 20 người dùng
        $productIds = range(1, 50);
        $userIds = range(1, 20);

        // Mảng các câu bình luận mẫu bằng tiếng Việt
        $vietnameseComments = [
            "Sách rất hay, tôi rất thích! Nội dung sâu sắc và dễ hiểu.",
            "Cuốn sách này đã mở ra một chân trời mới cho tôi. Rất đáng đọc!",
            "Tôi bị cuốn hút từ trang đầu tiên. Cách viết của tác giả thật tuyệt vời.",
            "Đây là một cuốn sách mà tôi sẽ giới thiệu cho tất cả bạn bè của mình.",
            "Nội dung sách rất bổ ích, đặc biệt là phần về [chủ đề cụ thể]. Tôi học được rất nhiều.",
            "Sách hay nhưng hơi khó đọc. Cần tập trung cao độ để hiểu hết ý tác giả.",
            "Tôi đã đọc cuốn này trong một ngày! Không thể dừng lại được.",
            "Cuốn sách này đã thay đổi cách nhìn của tôi về [chủ đề]. Thật sự ấn tượng!",
            "Tôi ước mình đọc cuốn sách này sớm hơn. Nó đã giải đáp nhiều thắc mắc của tôi.",
            "Sách rất chi tiết và đầy đủ thông tin. Tuyệt vời cho người muốn tìm hiểu sâu về chủ đề này.",
            "Cách trình bày của tác giả rất logic và dễ theo dõi. Tôi rất thích cách cấu trúc của sách.",
            "Đây là cuốn sách mà tôi sẽ đọc đi đọc lại nhiều lần. Mỗi lần đọc lại đều có những phát hiện mới.",
            "Sách hay nhưng giá hơi cao. Tuy nhiên, tôi nghĩ nó xứng đáng với giá tiền.",
            "Tôi đã mua cuốn này cho cả gia đình đọc. Mọi người đều rất thích!",
            "Phần minh họa trong sách rất đẹp và sinh động. Giúp hiểu nội dung dễ dàng hơn nhiều.",
            "Tôi không phải là người thích đọc sách, nhưng cuốn này đã làm tôi thay đổi.",
            "Sách này đã giúp tôi trong công việc rất nhiều. Nhiều ý tưởng practical và áp dụng được ngay.",
            "Tôi thấy một số chương hơi dài dòng, nhưng nhìn chung vẫn là một cuốn sách tốt.",
            "Đây là món quà tuyệt vời cho bất kỳ ai quan tâm đến [chủ đề của sách].",
            "Tôi đã đọc nhiều sách về chủ đề này, nhưng cuốn này là xuất sắc nhất.",
            "Sách có nhiều ví dụ thực tế, giúp tôi hiểu rõ hơn về lý thuyết.",
            "Tôi rất ấn tượng với độ sâu của nghiên cứu trong cuốn sách này.",
            "Đọc xong cuốn này, tôi cảm thấy được truyền cảm hứng để bắt đầu [một hoạt động nào đó].",
            "Sách hơi khô khan ở vài chỗ, nhưng nhìn chung là rất informative.",
            "Tôi đã highlight gần như mỗi trang của cuốn sách. Quá nhiều thông tin hữu ích!",
            "Cuốn sách này đã giúp tôi vượt qua một giai đoạn khó khăn trong cuộc sống.",
            "Tôi mua sách này vì bìa đẹp, nhưng nội dung còn tuyệt vời hơn cả vẻ ngoài.",
            "Sách rất dễ đọc nhưng không hề hời hợt. Tác giả đã làm rất tốt trong việc cân bằng này.",
            "Tôi đã đọc bản ebook trước, nhưng vẫn quyết định mua bản giấy để sưu tầm.",
            "Đây là cuốn sách mà tôi nghĩ nên được đưa vào chương trình giảng dạy ở trường.",
        ];

        // Tạo 200 bình luận mẫu
        for ($i = 0; $i < 9000000; $i++) {
            DB::table('comments')->insert([
                'id_product' => $faker->randomElement($productIds),
                'id_user' => $faker->randomElement($userIds),
                'rating' => $faker->numberBetween(1, 5),
                'content' => $faker->randomElement($vietnameseComments),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
