<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailClerkInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $clerk;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clerk, $password)
    {
        $this->clerk = $clerk;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mindwave: Cuenta creada por la empresa ' . $this->clerk->parent()->name)
                    ->markdown('enterprise.email.clerks.create');
    }
}
