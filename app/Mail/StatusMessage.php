<?php

namespace App\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Données pour la vue
    public $type; // Données pour la vue

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $type)
    {
        //
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [];

        if($this->type == "quote"){

            $data['fullname'] = $this->data->lastname.' '.$this->data->firstname;
            $data['entity'] = "devis";
            $data['url'] = url('/profil');
            $data['status'] = Controller::status($this->data->status);

            $this->data = $data;

            return $this->from("contact@reliefservices.space") // L'expéditeur
                    ->subject("Mise à jour de statut du devis") // Le sujet
                    ->markdown('layouts.mail-status')
                    ->with('data',$this->data);
        }else{

            $data['fullname'] = $this->data->lastname.' '.$this->data->firstname;
            $data['entity'] = "dossier";
            $data['url'] = url('/profil');
            $data['status'] = Controller::status($this->data->status);

            $this->data = $data;

            return $this->from("contact@reliefservices.space") // L'expéditeur
                    ->subject("Mise à jour de statut du dossier") // Le sujet
                    ->markdown('layouts.mail-status')
                    ->with('data',$this->data);
        }
    }
}
