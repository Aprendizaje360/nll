<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailResults extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $intervention;
    public $resultsUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $intervention)
    {
        $this->user = $user;
        $this->intervention = $intervention;
        $this->resultsUrl = route('enterprise.users.getResults', ['user' => $user, 'intervention' => $intervention]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resultados de la intervención ' . $this->intervention->title)
            ->markdown('enterprise.email.users.results');
    }
}
