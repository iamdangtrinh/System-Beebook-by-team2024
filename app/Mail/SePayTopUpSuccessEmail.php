<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SePayTopUpSuccessEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $sePayWebhookData;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @param  mixed  $sePayWebhookData
     * @return void
     */
    public function __construct($user, $sePayWebhookData)
    {
        $this->user = $user;
        $this->sePayWebhookData = $sePayWebhookData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Top Up Successful')
                    ->view('emails.sepay_topup_success');
    }
}
