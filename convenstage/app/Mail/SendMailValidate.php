<?php

namespace App\Mail;

use App\Models\Tache;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailValidate extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Tache $tache)
    {
        $this->data = [
            'user' => $user,
            'tache' => $tache
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('C\'est à vous !' )->markdown('mails.markdown-sendmailvalidate');
    }
}
