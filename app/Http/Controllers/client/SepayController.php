<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SePay\SePay\Models\SePayTransaction;
use Illuminate\Validation\ValidationException;
use SePay\SePay\Datas\SePayWebhookData;
use Illuminate\Support\Str;
use SePay\SePay\Events\SePayWebhookEvent;

class SepayController extends Controller
{
    public function webhook(Request $request)
    {
        $token = $this->bearerToken($request);

        if (config('sepay.webhook_token') && $token == config('sepay.webhook_token')) {
            $sePayWebhookData = new SePayWebhookData(
                $request->integer('id'),
                $request->string('gateway')->value(),
                $request->string('transactionDate')->value(),
                $request->string('accountNumber')->value(),
                $request->string('subAccount')->value(),
                $request->string('code')->value(),
                $request->string('content')->value(),
                $request->string('transferType')->value(),
                $request->string('description')->value(),
                $request->integer('transferAmount'),
                $request->string('referenceCode')->value(),
                $request->integer('accumulated')
            );

            throw_if(
                SePayTransaction::query()->whereId($sePayWebhookData->id)->exists(),
                ValidationException::withMessages(['message' => ['transaction này đã thực hiện']])
            );

            $model = new SePayTransaction();
            $model->id = $sePayWebhookData->id;
            $model->gateway = $sePayWebhookData->gateway;
            $model->transactionDate = $sePayWebhookData->transactionDate;
            $model->accountNumber = $sePayWebhookData->accountNumber;
            $model->subAccount = $sePayWebhookData->subAccount;
            $model->code = $sePayWebhookData->code;
            $model->content = $sePayWebhookData->content;
            $model->transferType = $sePayWebhookData->transferType;
            $model->description = $sePayWebhookData->description;
            $model->transferAmount = $sePayWebhookData->transferAmount;
            $model->referenceCode = $sePayWebhookData->referenceCode;
            $model->save();

            // Lấy ra user id hoặc order id ví dụ: SE_123456, SE_abcd-efgh
            $pattern = '/\b' . config('sepay.pattern') . '([a-zA-Z0-9-_])+/';
            preg_match($pattern, $sePayWebhookData->code, $matches);

            if (isset($matches[0])) {
                // Lấy bỏ phần pattern chỉ còn lại id ex: 123456, abcd-efgh
                $info = Str::of($matches[0])->replaceFirst(config('sepay.pattern'), '')->value();

                if ($info) {
                    $idBill = BillModel::findOrFail($info);
                    $idBill->payment_status = 'PAID';
                    $idBill->save();
                    // $emailBought = BillModel::where('id', $info)->pluck('email')->first();
                    // Mail::to('dtrinhit84@gmail.com')->send(new \App\Mail\sendEmailOrder($info));

                    Mail::raw('Order: ' . $info , function ($message) {
                        $message->to('dtrinhit84@gmail.com')
                            ->subject('Hello Email');
                    });
                }
                event(new SePayWebhookEvent($info, $sePayWebhookData));
                // return redirect()->route('thankyou.index', ['id' => 8]);
            }
            return response()->noContent();
        } else {
            // Gửi email cảnh báo nếu token không hợp lệ
            Mail::raw(
                'Có lỗi: Invalid Token: ' . $token . ' Config: ' . config('sepay.webhook_token') . ' Request: ' . $request,
                function ($message) {
                    $message->to('dtrinhit04@gmail.com')
                        ->subject('Invalid Token');
                }
            );
            throw ValidationException::withMessages(['message' => ['Invalid Token']]);
        }
    }

    /**
     * Get the bearer token from the request headers.
     *
     * @return string|null
     */
    private function bearerToken(Request $request)
    {
        $header = $request->header('Authorization', '');

        $position = strrpos($header, 'Apikey ');

        if ($position !== false) {
            $header = substr($header, $position + 7);

            return str_contains($header, ',') ? (strstr($header, ',', true) ?: null) : $header;
        }

        return null;
    }
}
