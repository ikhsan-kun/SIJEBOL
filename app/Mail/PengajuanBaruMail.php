<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PengajuanLayanan;
use App\Models\User;

class PengajuanBaruMail extends Mailable
{
    use Queueable, SerializesModels;

    public $permohonan;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Permohonan $permohonan, User $user)
    {
        $this->permohonan = $permohonan;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tiket Pengajuan Baru: ' . $this->permohonan->nomor_tiket,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pengajuan-baru',
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
