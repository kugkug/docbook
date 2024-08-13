<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subject;
    public $view;
    public $data;
    public $type;
    public function __construct($array_info)
    {
        $this->type = $array_info['type'];
        $this->subject = $array_info['subject'];
        $this->view = $array_info['view'];
        $this->data = $array_info['data'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->type != "test") {
            return new Content(
                view: 'mailer.'.$this->view,
                with: [
                    'password' => $this->data['password']
                ]
            );
        } else {
            return new Content(
                view: 'mailer.'.$this->view
            );
        }
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