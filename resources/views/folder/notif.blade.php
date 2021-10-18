@component('mail::message')
<h1>Hello {{ $data['lastname'] }} {{ $data['firstname'] }},</h1>

<p>
    Votre dossier a été traité vous pouvez payer pour bénéficier du service.

    @component('mail::button', ['url' => config('app.url').'admin/list-refills'])
    Payer les Frais de service
    @endcomponent
</p>

Cordialement,<br>
Relief Service <br>
contact@reliefservice.space , (+241) 077 613 799
@endcomponent
