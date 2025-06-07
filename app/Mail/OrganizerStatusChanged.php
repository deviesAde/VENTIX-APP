<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganizerStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $organizer;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($organizer, $status)
    {
        $this->organizer = $organizer;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Status Pendaftaran Organizer Anda')
                    ->view('emails.organizer-status-changed')
                    ->with([
                        'organizer' => $this->organizer,
                        'status' => $this->status,
                    ]);
    }
}
