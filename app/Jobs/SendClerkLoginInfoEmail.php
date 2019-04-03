<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\EmailClerkInfo;

class SendClerkLoginInfoEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $clerk;
    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clerk, $password)
    {
        $this->clerk = $clerk;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new EmailClerkInfo($this->clerk, $this->password);
        Mail::to($this->clerk->email)->send($email);
    }
}
