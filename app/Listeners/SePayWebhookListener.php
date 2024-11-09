<?php

namespace App\Listeners;

use App\Models\BillModel;
use App\Models\User;
use SePay\SePay\Events\SePayWebhookEvent;
use SePay\SePay\Notifications\SePayTopUpSuccessNotification;
use Illuminate\Support\Facades\Log;
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

            // $emailBought = BillModel::where('id', $event->info)->pluck('email')->first();
            // Mail::raw('Order: ' . $emailBought, function ($message) {
            //     $message->to('dtrinhit84@gmail.com')
            //         ->subject('Hello Email');
            // });

            // try {
            //     if ($emailBought) {
            //         Mail::to('dtrinhit84@gmail.com')->send(new \App\Mail\sendEmailOrder($event->info));
            //         Mail::to($emailBought)->send(new \App\Mail\sendEmailOrder($event->info));
            //     }
            // } catch (\Exception $e) {
            //     Log::error('Email sending failed: ' . $e->getMessage());
            // }

            // $emailBought = BillModel::where('id', $event->info)->pluck('email')->first();
            // $user = User::query()->where('email', $emailBought)->first();
            // if ($user instanceof User) {
            //     $user->notify(new SePayTopUpSuccessNotification($event->sePayWebhookData));
            // }
            // redirect()->route('thankyou.index', ['id' => ($event->info)]);
        } else {
            // Xử lý tiền ra tài khoản
        }
    }
}
