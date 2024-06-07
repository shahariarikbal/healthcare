<?php

namespace App\Jobs;

use App\Mail\PatientOfferEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PatientOfferEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $dynamicData;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $dynamicData)
    {
        $this->email = $email;
        $this->dynamicData = $dynamicData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if(is_array($this->dynamicData) && isset($this->dynamicData['email_to'])){
            $email = new PatientOfferEmail($this->dynamicData);
            Mail::to($this->email)->send($email);
        }

        sleep(1);
    }
}
