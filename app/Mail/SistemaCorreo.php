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
    public $estado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solicitud)
    {
        $this->solicitud = $solicitud;
        $this->estado = $solicitud->estado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->estado == "Aceptada") {
            if($this->solicitud->tipo_facilidad == null){
                return $this->view('emails.resolucionAceptada1')->with('solicitud', $this->solicitud);
            }
            return $this->view('emails.resolucionAceptada2')->with('solicitud', $this->solicitud);
        }
        if ($this->estado == "Rechazada") {
            if($this->solicitud->tipo_facilidad == null){
                return $this->view('emails.resolucionRechazada1')->with('solicitud', $this->solicitud);
            }
            return $this->view('emails.resolucionRechazada2')->with('solicitud', $this->solicitud);
        }

        if ($this->estado == "Aceptada con observaciones") {
            if($this->solicitud->tipo_facilidad == null){
                return $this->view('emails.resolucionAceptadaObservacion1')->with('solicitud', $this->solicitud);
            }
            return $this->view('emails.resolucionAceptadaObservacion2')->with('solicitud', $this->solicitud);
        }
    }
}
