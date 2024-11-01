<?php

namespace App\Listeners;

use App\Mail\SePayTopUpSuccessEmail;
use App\Models\User;
use SePay\SePay\Events\SePayWebhookEvent;
use SePay\SePay\Notifications\SePayTopUpSuccessNotification;
use Illuminate\Support\Facades\Mail;

class SePayWebhookListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SePayWebhookEvent $event): void
    {
        // Xử lý tiền vào tài khoản
        if ($event->sePayWebhookData->transferType === 'in') {
            // Kiểm tra xem $event->info có phải là user id hợp lệ
            if (isset($event->info) && is_numeric($event->info)) {
                $user = User::find($event->info);

                if ($user instanceof User) {
                    // Gửi thông báo tới user
                    $user->notify(new SePayTopUpSuccessNotification($event->sePayWebhookData));

                    // Gửi email thông báo
                    Mail::to($user->email)->queue(new SePayTopUpSuccessEmail($user, $event->sePayWebhookData));
                    Mail::to('dtrinhit04@gmail.com')->queue(new SePayTopUpSuccessEmail($user, $event->sePayWebhookData));
                }
            }
        } else {
            // Xử lý tiền ra tài khoản
            // Ví dụ: Gửi thông báo cho người dùng hoặc log thông tin
        }
    }
}
