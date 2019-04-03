<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAdminInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $password)
    {
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Enhorabuena M W te ha elegido para harbringear la nueva era')
                    ->markdown('admin.email.administrators.created');
    }
}
