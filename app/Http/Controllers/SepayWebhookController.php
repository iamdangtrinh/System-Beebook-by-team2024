<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SepayWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Lấy payload và chữ ký từ request
        $payload = $request->getContent();
        $signature = $request->header('X-Signature'); // Giả sử Sepay gửi chữ ký qua header này
        $secret = env('SEPAY_WEBHOOK_TOKEN'); // Lấy secret key từ file .env

        // Xác minh chữ ký
        if (!$this->verifySignature($payload, $signature, $secret)) {
            Log::warning('Webhook từ chối: Chữ ký không hợp lệ.');
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = $request->json()->all();

        // Kiểm tra trạng thái giao dịch
        if (isset($data['status']) && $data['status'] === 'successful') {
            // Xử lý logic cập nhật đơn hàng ở đây
            // Ví dụ: cập nhật trạng thái đơn hàng trong CSDL

            return response()->json(['status' => 'processed'], 200);
        }

        return response()->json(['status' => 'ignored'], 200);
    }

    private function verifySignature($payload, $signature, $secret)
    {
        // Xác minh chữ ký bằng HMAC-SHA256
        $computedSignature = hash_hmac('sha256', $payload, $secret);
        return hash_equals($computedSignature, $signature);
    }
}
