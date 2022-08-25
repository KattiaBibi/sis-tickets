<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequerimientoEmail extends Mailable
{
  use Queueable, SerializesModels;

  protected $requerimiento, $colaborador;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($requerimiento, $colaborador)
  {
    $this->requerimiento = $requerimiento;
    $this->colaborador = $colaborador;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $subject = "";
    $subject = "👉 Asignación al requerimiento: " . strtoupper($this->requerimiento->titulo);

    return $this->view('mails.requerimiento')
      ->subject($subject)
      ->with([
        'requerimiento' => $this->requerimiento,
        'colaborador' => $this->colaborador,
      ]);
  }
}
