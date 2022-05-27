<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestSendEmail extends Mailable
{
  use Queueable, SerializesModels;

  protected $cita, $asistente;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($cita, $asistente)
  {
    $this->cita = $cita;
    $this->asistente = $asistente;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('mails.test')
      ->subject('Invitación a la reunion: ' . $this->cita->titulo)
      ->with([
        'cita' => $this->cita,
        'asistente' => $this->asistente
      ]);
  }
}
