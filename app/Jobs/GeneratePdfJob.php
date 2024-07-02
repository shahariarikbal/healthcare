<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $appointment;
    protected $storeBill;
    public function __construct($appointment, $storeBill)
    {
        $this->appointment = $appointment;
        $this->storeBill = $storeBill;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('admin.pages.billings.receipt', [
            'appointment' => $this->appointment,
            'bill' => $this->storeBill
        ]);

        $pdfPath = storage_path('app/public/bills/'.$this->storeBill->invoiceId. '.pdf');
        $pdf->save($pdfPath);
    }
}
