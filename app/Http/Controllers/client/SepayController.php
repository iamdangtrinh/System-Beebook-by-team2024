<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
use Carbon\Carbon;
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
            // Lấy ra user id hoặc order id ví dụ: SE_123456, SE_abcd-efgh
            $pattern = '/\b' . config('sepay.pattern') . '([a-zA-Z0-9-_])+/';
            preg_match($pattern, $sePayWebhookData->code, $matches);
            
            if (isset($matches[0])) {
                // Lấy bỏ phần pattern chỉ còn lại id ex: 123456, abcd-efgh
                $info = Str::of($matches[0])->replaceFirst(config('sepay.pattern'), '')->value();
                
                if ($info) {
                    $idBill = BillModel::findOrFail($info);
                    if ((float) $sePayWebhookData->transferAmount === (float) $idBill->total_amount) {
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

                        $idBill->payment_status = 'PAID';
                        $idBill->save();
                    }
                }
                event(new SePayWebhookEvent($info, $sePayWebhookData));
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

    public function show()
    {
        $data = SePayTransaction::paginate(20);
        if (request()->has(['start_date', 'end_date'])) {
            $startDate = request('start_date');
            $endDate = request('end_date');

            // end_date > start_date
            if (strtotime($startDate) > strtotime($endDate)) {
                return redirect()->back()->with('error', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
            }

            if (strtotime($startDate) && strtotime($endDate)) {
                $data = SePayTransaction::whereBetween('transactionDate', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ])->paginate(10);
            } else {
                return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại!');
            }
        }



        return view('admin.transaction.index', compact('data'));
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
