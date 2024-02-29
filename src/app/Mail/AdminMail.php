<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_subject;
    public $mail_message;

    public function __construct($mail_subject, $mail_message)
    {
        $this->mail_subject = $mail_subject;
        $this->mail_message = $mail_message;
    }

    public function build()
    {
        $view = $this->view('emails.admin_email');
        $mail_subject = $this->mail_subject;

        return $view->subject($mail_subject);
    }

}
