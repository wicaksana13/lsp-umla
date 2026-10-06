<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ParticipantRegistration;

class ParticipantRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $note;

    public function __construct(ParticipantRegistration $registration, $note)
    {
        $this->registration = $registration;
        $this->note = $note;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Status Pendaftaran LSP UMLA')
                    ->view('emails.participant_rejected'); // Buat view email penolakan sesuai kebutuhan
    }
}