<?php

namespace App\Jobs;

use App\Mail\AppointmentBookingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AppointmentBookingMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $email;
    protected $appointmentInfo;
    public function __construct($email, $appointmentInfo)
    {
        $this->email = $email;
        $this->appointmentInfo = $appointmentInfo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = new AppointmentBookingMail($this->appointmentInfo);
        Mail::to($this->email)->send($data);

        sleep(1);
    }
}
