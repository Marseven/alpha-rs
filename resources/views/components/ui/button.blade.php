@props([
    'variant' => 'primary', // accent | primary | outline | ghost
    'href' => null,
    'type' => 'button',
])
@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg px-5 min-h-[44px] text-[15px] font-bold transition-colors duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-600';
    $variants = [
        'accent'  => 'bg-accent-600 text-white shadow-cta hover:bg-accent-700', // CTA principal unique
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700',
        'outline' => 'border-[1.5px] border-primary-600 text-primary-600 bg-white hover:bg-primary-50',
        'ghost'   => 'bg-canvas text-ink-muted hover:bg-line-subtle',
    ];
    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
