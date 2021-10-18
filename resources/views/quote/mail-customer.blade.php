@component('mail::message')
<h1>Hello {{ $data['lastname'] }} {{ $data['firstname'] }},</h1>

<p>
    Nous avons reçu votre demande et nous reviendrons vers le plus rapidement possible.

    @component('mail::button', ['url' => config('app.url').'admin/list-refills'])
    Payer les Frais de service
    @endcomponent

    Cordialement,<br>
Relief Service <br>
contact@reliefservice.space , (+241) 077 613 799
</p>

@endcomponent
