@props([
    'type' => 'info', // info | success | warning | danger
])
@php
    $map = [
        'info'    => 'text-primary-700 bg-primary-50 border-primary-200',
        'success' => 'text-success-700 bg-success-50 border-success-200',
        'warning' => 'text-warning-700 bg-warning-50 border-warning-200',
        'danger'  => 'text-accent-700 bg-accent-50 border-accent-100',
    ];
    $classes = $map[$type] ?? $map['info'];
@endphp
<div {{ $attributes->merge(['class' => 'flex items-start gap-3 rounded-xl border px-4 py-3 text-sm ' . $classes]) }}>
    {{ $slot }}
</div>
