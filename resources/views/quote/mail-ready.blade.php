@component('mail::message')
# Votre devis est prêt

Bonjour {{ $fullname ?: 'cher client' }},

Votre demande **{{ $reference }}**@if($service) ({{ $service }})@endif a été traitée.
@if($attached)
Vous trouverez **votre devis en pièce jointe** de cet e-mail.
@else
Votre devis est disponible dans votre espace client (bouton ci-dessous).
@endif

@if($response)
**Message de notre équipe :**

> {{ $response }}
@endif

@component('mail::button', ['url' => $url])
Voir et régler mon devis
@endcomponent

Vous pouvez consulter et régler votre devis à tout moment depuis votre espace client.

Cordialement,
L'équipe Relief Services
contact@reliefservices.net · (+241) 076 55 57 81
@endcomponent
