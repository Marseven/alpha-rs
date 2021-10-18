<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Données pour la vue

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['email'] == "m.cherone@reliefservices.space"){

            return $this->from("contact@reliefservices.space") // L'expéditeur
                        ->subject($this->data['subject']) // Le sujet
                        ->markdown('quote.mail')
                        ->with('data',$this->data);
        }else{

            return $this->from("contact@reliefservices.space") // L'expéditeur
                        ->subject($this->data['subject']) // Le sujet
                        ->markdown('quote.mail-customer')
                        ->with('data',$this->data);
        }

    }
}
