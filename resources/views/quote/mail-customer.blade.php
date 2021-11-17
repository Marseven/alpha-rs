@component('mail::message')
    <h1>Hello {{ $data['lastname'] }} {{ $data['firstname'] }},</h1>

    Nous avons reçu votre demande et nous reviendrons vers le plus rapidement possible.

    Cordialement,<br>
    Relief Service <br>
    contact@reliefservice.space , (+241) 077 613 799

@endcomponent
