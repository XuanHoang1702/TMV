<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title;
    public $body;
    public $url;

    public function __construct($user, $title, $body, $url)
    {
        $this->user = $user;
        $this->title = $title;
        $this->body = $body;
        $this->url = $url;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.email',
            with: [
                'user' => $this->user,
                'title' => $this->title,
                'body'  => $this->body,
                'url'   => $this->url,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

