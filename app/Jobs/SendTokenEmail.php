<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\EmailToken;

class SendTokenEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $token;
    protected $user;
    protected $intervention;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $token, $intervention)
    {
        $this->token = $token;
        $this->user = $user; 
        $this->intervention = $intervention;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new EmailToken($this->user, $this->token, $this->intervention);
        Mail::to($this->user->email_company)->send($email);
    }
}
