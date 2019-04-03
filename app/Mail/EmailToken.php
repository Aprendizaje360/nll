<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailToken extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $intervention;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token, $intervention)
    {
        $this->user = $user;
        $this->token = $token;
        $this->intervention = $intervention;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Token para la intervención ' . $this->intervention->title)
                    ->markdown('enterprise.email.users.token');
    }
}
