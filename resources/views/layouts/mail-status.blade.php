@component('mail::message')
    <h1>Hello {{ $data['fullname'] }},</h1>

    Votre {{ $data['entity'] }} a changé de statut. Son nouveau statut est désormais {{ $data['status'] }}. <br><br>


    @component('mail::button', ['url' => $data['url']])
        Voir le {{ $data['entity'] }}
    @endcomponent

    <br>

    Cordialement,<br>
    Relief Service<br>
    contact@reliefservice.space , (+241) 077 613 799
@endcomponent
