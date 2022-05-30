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
    return $this->view('mails.cita')
      ->subject('Invitación a la reunion: ' . $this->cita->titulo)
      ->with([
        'cita' => $this->cita,
        'asistente' => $this->asistente,
        'tipoAsunto' => $this->tipoAsunto
      ]);
  }
}
