<?php

namespace App\Listeners;

use App\Models\BillModel;
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

<<<<<<< HEAD
            $user = User::query()->where('id', $event->info)->first();
            if ($user instanceof User) {
                $user->notify(new SePayTopUpSuccessNotification($event->sePayWebhookData));
            }
            Mail::raw('hello', function ($message) {
                $message->to('dtrinhit84@gmail.com')
                        ->subject('Hello Email');
            });
        } else {
            // Xử lý tiền ra tài khoản
        }
        
         Mail::raw('hello', function ($message) {
                    $message->to('dtrinhit04@gmail.com')
                            ->subject('Hello Email');
                });
=======
            $emailBought = BillModel::select(['email'])->where('id', $event->info);
            Mail::to($emailBought)->send(new \App\Mail\sendEmailOrder($event->info));
            redirect()->route('thankyou.index', ['id' => ($event->info)]);

            // Trường hợp $info là user id
            // $user = User::query()->where('id', $event->info)->first();
            // if ($user instanceof User) {
            //     $user->notify(new SePayTopUpSuccessNotification($event->sePayWebhookData));
            // }
        } 
>>>>>>> 88f16eb3e65d6a97ce2208a19d975032e14b7a02
    }
}
