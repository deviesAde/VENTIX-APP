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
    public $password;
    public $subject = 'Status Pendaftaran Organizer Anda';


    /**
     * Create a new message instance.
     */
    public function __construct($organizer, $status, $password)
    {
        $this->organizer = $organizer;
        $this->status = $status;
        $this->password = $password;


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
