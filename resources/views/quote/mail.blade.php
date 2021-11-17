@component('mail::message')
    <h1>Hello {{ config('app.name') }},</h1>

    Nous souhaitons avoir un devis pour les informations suivante :
    Catégorie : {{ $data['category'] }} <br>
    Service : {{ $data['service'] }} <br>
    Pays : {{ $data['pays'] }} <br><br>

    @component('mail::button', ['url' => config('app.url') . 'admin/list-quotes'])
        Liste des devis
    @endcomponent

    Cordialement,<br>
    {{ $data['lastname'] }} {{ $data['firstname'] }} <br>
    {{ $data['email'] }} , {{ $data['phone'] }}

@endcomponent
