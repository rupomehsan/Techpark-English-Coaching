<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;
    public string $userName;

    public function __construct(string $otp, string $userName = 'User')
    {
        $this->otp      = $otp;
        $this->userName = $userName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your Password Reset Code — TechPark English');
    }

    public function content(): Content
    {
        return new Content(view: 'frontend.emails.otp_reset');
    }

    public function attachments(): array
    {
        return [];
    }
}
