<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Services\Api\InterventionService;
use Mail;
use App\Mail\EmailResults;
use App\Entities\User;
use App\Entities\Intervention;


class ProcessResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120;

    private $csvFile;
    private $results;
    private $interventionServ;
    private $user;
    private $intervention;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $results, InterventionService $interventionServ, $userId, $interventionId)
    {
        $this->csvFile = storage_path('/app/' . $filePath);
        $this->results = $results;
        $this->interventionServ = $interventionServ;
        $this->user = User::find($userId);
        $this->intervention = Intervention::find($interventionId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
          
        \DB::beginTransaction();

        $csvResults = $this->interventionServ->parseAndStoreFile($this->csvFile);
        $interventionResult = $this->interventionServ->parseAndStoreResultsData($this->results, $csvResults);
        
        \DB::commit();

        $email = new EmailResults($this->user, $this->intervention);
        Mail::to($this->user->email_company)->send($email);

        } catch (\Exception $e) {
            \App\Entities\Log::create(['name' => 'DATA_CONTENT_FAILURE', 'description' => $e->getMessage() . $e->getTraceAsString()]);
        }
    }
}
