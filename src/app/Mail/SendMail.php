<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment,$userName) {
        $this->userName = $userName;
        $this->comment = $comment;
    }


    public function build() {
        return $this->view('emails.temple')
                    ->with([
                        'userName' => $this -> userName,
                        'comment' => $this -> comment,
                    ])
                    ->subject('管理者からのコメント');
    }
}
