<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatientOfferEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $dynamicData;
    /**
     * Create a new message instance.
     */
    public function __construct($dynamicData)
    {
        $this->dynamicData = $dynamicData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->dynamicData['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('admin.pages.email.template')->with('dynamicData', $this->dynamicData);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    
}
