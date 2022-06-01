<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CitaEmail extends Mailable
{
  use Queueable, SerializesModels;

  protected $cita, $asistente, $tipoAsunto;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($cita, $asistente, $tipoAsunto)
  {
    $this->cita = $cita;
    $this->asistente = $asistente;
    $this->tipoAsunto = $tipoAsunto;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $subject = "";
    if ($this->tipoAsunto === 'INVITACION') {
      $subject = "👉 Invitación a la reunión " . strtoupper($this->cita->tipo) . " " . $this->cita->titulo;
    } elseif ($this->tipoAsunto === 'REPROGRAMACION') {
      $subject = "👉 Reprogramación de la reunión " . strtoupper($this->cita->tipo) . " " . $this->cita->titulo;
    } else {
      $subject = "👉 Se te eliminó de la reunión " . strtoupper($this->cita->tipo) . " " . $this->cita->titulo;
    }

    return $this->view('mails.cita')
      ->subject($subject)
      ->with([
        'cita' => $this->cita,
        'asistente' => $this->asistente,
        'tipoAsunto' => $this->tipoAsunto
      ]);
  }
}
