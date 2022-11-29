@component('mail::message')
    <h1>Hello {{ $data['fullname'] }},</h1>

    Votre {{ $data['entity'] }} a changé de statut. Son nouveau statut est désormais {{ $data['status']['message'] }}.


    --

    Cordialement,
    Relief Service
    contact@reliefservice.space , (+241) 077 613 799
@endcomponent
