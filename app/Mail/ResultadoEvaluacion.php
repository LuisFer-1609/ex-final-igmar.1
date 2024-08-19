<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResultadoEvaluacion extends Mailable
{
    use Queueable, SerializesModels;

    public $respuestas = null;
    public $evaluacion = null;
    public $signedUrl = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($respuestas, $evaluacion, $signedUrl)
    {
        $this->respuestas = $respuestas;
        $this->evaluacion = $evaluacion;
        $this->signedUrl = $signedUrl;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Resultado Evaluacion',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.resultado_evaluacion',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
