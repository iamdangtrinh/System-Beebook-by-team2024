<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\CouponModel;
use Carbon\Carbon;


class BillsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $generatedPhones = [];
        // Lấy danh sách user và coupon
        $users = User::pluck('id')->toArray(); // Lấy danh sách id của user
        $coupons = CouponModel::select('id', 'discount')->get(); // Lấy danh sách id và discount của coupon
        $statuses = ['new', 'success', 'cancel', 'refund', 'shipping'];
        $paymentMethods = ['ONLINE', 'OFFLINE'];
        $paymentStatuses = ['PAID', 'UNPAID'];
        $notes = [
            'Khách hàng yêu cầu kiểm tra kỹ sản phẩm trước khi giao.',
            'Vui lòng gọi điện xác nhận trước khi giao hàng.',
            'Giao hàng sau 18h vì khách hàng không có nhà buổi sáng.',
            'Khách hàng muốn nhận hàng tại địa chỉ khác.',
            'Yêu cầu đóng gói sản phẩm cẩn thận.',
            'Khách hàng đã thanh toán trước qua chuyển khoản.',
            'Sản phẩm cần kiểm tra tem bảo hành trước khi giao.',
            'Không giao hàng vào ngày chủ nhật.',
            'Khách hàng yêu cầu hóa đơn đỏ.',
            'Hàng cần giao gấp trong ngày.'
        ];

        $notesAdmin = [
            'Kiểm tra lại tồn kho trước khi xuất hàng.',
            'Liên hệ với khách hàng để xác nhận thông tin địa chỉ.',
            'Hóa đơn đã được tạo và đang chờ phê duyệt.',
            'Khách hàng đã khiếu nại về đơn hàng trước đó.',
            'Sản phẩm thuộc lô mới nhập, cần kiểm tra lại.',
            'Liên hệ bộ phận vận chuyển để xác nhận lịch giao.',
            'Đơn hàng đã được hủy theo yêu cầu của khách.',
            'Đơn hàng bị hoàn lại, cần xử lý tồn kho.',
            'Đơn hàng đang chờ xác nhận từ quản lý.',
            'Khách hàng yêu cầu đổi sản phẩm sang mã khác.'
        ];

        for ($i = 0; $i < 1000; $i++) {
            $randomCoupon = $coupons->random();
            $randomDate = Carbon::now()->subMonths(rand(0, 12))->subDays(rand(0, 30));
            $phone = $this->generateUniquePhone($generatedPhones);
            DB::table('bills')->insert([
                'id_user' => $faker->randomElement($users), // Chọn ngẫu nhiên một user
                'id_coupon' => $randomCoupon ? $randomCoupon->id : null, // ID coupon hoặc null
                'status' => $faker->randomElement($statuses),
                'reason_cancel' => $faker->optional()->sentence(),
                'total_amount' => $faker->randomFloat(2, 50, 5000),
                'payment_method' => $faker->randomElement($paymentMethods),
                'payment_status' => $faker->randomElement($paymentStatuses),
                'shipping_method' => 'GHN',
                'fee_shipping' => $faker->optional()->randomFloat(2, 5, 50),
                'discount' => $randomCoupon ? $randomCoupon->discount : null, // Lấy discount từ danh sách coupon
                'address' => $faker->address,
                'email' => $faker->unique()->userName . '@gmail.com',
                'name' => $faker->name,
                'phone' => $phone,
                'note' =>  $faker->optional()->randomElement($notes),
                'note_admin' =>  $faker->optional()->randomElement($notesAdmin),
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
    private function generateUniquePhone(array &$generatedPhones): string
    {
        $prefix = ['032', '033', '034', '035', '036', '037', '038', '039', '070', '079'];
        do {
            $randomPrefix = $prefix[array_rand($prefix)]; // Lấy ngẫu nhiên đầu số hợp lệ
            $number = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT); // Tạo 7 số ngẫu nhiên
            $phone = $randomPrefix . $number; // Kết hợp đầu số và 7 số ngẫu nhiên
        } while (in_array($phone, $generatedPhones)); // Kiểm tra trùng lặp

        $generatedPhones[] = $phone; // Thêm số vào danh sách đã tạo
        return $phone;
    }
}