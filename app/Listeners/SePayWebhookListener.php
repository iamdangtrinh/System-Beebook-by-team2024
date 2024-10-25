<?php

namespace App\Listeners;

use App\Models\User;
use SePay\SePay\Events\SePayWebhookEvent;
use SePay\SePay\Notifications\SePayTopUpSuccessNotification;

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
            // Trường hợp $info là user id
            $user = User::query()->where('id', $event->info)->first();
            if ($user instanceof User) {
                $user->notify(new SePayTopUpSuccessNotification($event->sePayWebhookData));
            }
        } else {
            // Xử lý tiền ra tài khoản
        }
    }
}