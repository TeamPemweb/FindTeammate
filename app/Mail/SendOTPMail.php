<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOTPMail extends Mailable
{
    use Queueable, SerializesModels;
public function __construct(public $otp, public $name) {}

public function envelope(): Envelope {
    return new Envelope(subject: 'Kode OTP FindTeammate Kamu');
}

public function content(): Content {
    return new Content(view: 'auth.otp_mail');
}
}