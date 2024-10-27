<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HouseMaInquiryMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $email,
        public string $name,
        public string $inquiryType,
        public string $messageText,
        public mixed $property
    ) {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.houseMaInquiry')
                ->to(config('app.admin_email'), "ゆうかつ管理者様")
                ->from(config('email.from.address'), config('app.name'))
                ->subject('M&A物件のお問い合わせ')
                ->with([
                    'inquiryType' => $this->inquiryType,
                    'messageText' => $this->messageText,
                    'email' => $this->email,
                    'name' => $this->name,
                    'property' => $this->property,
                ]);
    }
}
