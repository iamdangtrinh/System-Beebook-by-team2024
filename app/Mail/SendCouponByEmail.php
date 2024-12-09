<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendCouponByEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $code_coupon = '';
    public $description = '';
    public $start_date = '';
    public $expires_at = '';
    public $coupon_min_spend = '';
    public $coupon_max_spend = '';
    public $discount = '';
    public $type_coupon = '';
    public $email = '';
    public function __construct($code_coupon, $description, $start_date, $expires_at, $coupon_max_spend, $coupon_min_spend, $discount, $type_coupon, $email,)
    {
        //
        $this->code_coupon = $code_coupon;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->expires_at = $expires_at;
        $this->coupon_max_spend = $coupon_max_spend;
        $this->coupon_min_spend = $coupon_min_spend;
        $this->discount = $discount;
        $this->type_coupon = $type_coupon;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Khuyến mãi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.SendCoupon',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}