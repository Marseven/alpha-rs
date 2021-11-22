@component('mail::message')
    <h1>Hello {{ config('app.name') }},</h1>

    Nous souhaitons avoir un devis pour les informations suivante :
    Catégorie : {{ $data->category }}
    Service : {{ $data->service->label }}
    Pays : {{ $data->country->label }}

    --

    Cordialement,
    {{ $data->lastname }} {{ $data->firstname }}
    {{ $data->email }} , {{ $data->phone }}

@endcomponent
