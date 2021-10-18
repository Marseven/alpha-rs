
@component('mail::message')
<h1>Hello {{ $data['fullname'] }},</h1>

<p>
    Votre  {{ $data['entity'] }} a changé de statut. Son nouveau statut est désormais {{ $data['status'] }}.

    @component('mail::button', ['url' => $data['url']])
        Voir le {{ $data['entity'] }}
    @endcomponent

    Cordialement,
    Relief Service
    contact@reliefservice.space , (+241) 077 613 799
</p>
@endcomponent
