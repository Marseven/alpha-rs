@props([
    'status' => null, // clé workflow CNAMGS (voir DESIGN_SYSTEM §2)
    'label' => null,
])
@php
    $map = [
        'DRAFT'               => ['Brouillon',          'text-ink-muted bg-canvas border-line'],
        'SENT_TO_CNAMGS'      => ['Transmis CNAMGS',    'text-primary-700 bg-primary-50 border-primary-200'],
        'RECEIVED_BY_CNAMGS'  => ['Reçu CNAMGS',        'text-primary-700 bg-primary-50 border-primary-200'],
        'IN_REVIEW'           => ["En cours d'examen",  'text-warning-700 bg-warning-50 border-warning-200'],
        'MISSING_INFORMATION' => ['Pièce manquante',    'text-accent-700 bg-accent-50 border-accent-100'],
        'READY'               => ['Prêt',               'text-success-700 bg-success-50 border-success-200'],
        'COMPLETED'           => ['Terminé',            'text-white bg-success-600 border-success-600'],
        'CANCELLED'           => ['Annulé',             'text-ink-muted bg-line-subtle border-line line-through'],
    ];
    [$mapLabel, $classes] = $map[$status] ?? [$label ?? $status, 'text-ink-muted bg-canvas border-line'];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold ' . $classes]) }}>{{ $label ?? $mapLabel }}</span>
