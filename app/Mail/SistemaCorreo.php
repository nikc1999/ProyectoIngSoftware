<?php

namespace App\Mail;

use App\Models\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SistemaCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Resolución de Solicitud";
    public $solicitud;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.resolución')->with('solicitud', $this->solicitud);
    }
}
