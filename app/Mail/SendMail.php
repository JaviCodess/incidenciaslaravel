<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($incidencia, $id)
    {
        //
        $this->incidencia = $incidencia;
        $this->id = $id; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sanchezfjaviersanchez@gmail.com')->subject('Incidencia')->view('email')->with('incidencia',$this->incidencia,'id',$this->id);
    }
}
