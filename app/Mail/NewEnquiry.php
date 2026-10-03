<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewEnquiry extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        $route = $this->lead->departure_city && $this->lead->delivery_city
            ? "{$this->lead->departure_city} → {$this->lead->delivery_city}"
            : 'New enquiry';

        return new Envelope(
            subject: "[Enquiry] {$this->lead->name} — {$route} ({$this->lead->phone})",
            replyTo: [$this->lead->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-enquiry',
            with: ['lead' => $this->lead],
        );
    }
}
