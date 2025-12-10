<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Lead $lead
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Form Submission - 10x Global EPOS',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form-submitted',
            text: 'emails.contact-form-submitted-text',
            with: [
                'leadName' => $this->lead->name,
                'leadEmail' => $this->lead->email,
                'leadPhone' => $this->lead->phone,
                'companyName' => $this->lead->company_name,
                'businessType' => $this->lead->business_type,
                'message' => $this->lead->message,
                'source' => $this->lead->source,
                'leadScore' => $this->lead->lead_score,
                'adminUrl' => route('admin.leads.show', $this->lead->id),
            ],
        );
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