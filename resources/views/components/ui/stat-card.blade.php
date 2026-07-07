@props([
    'label',
    'value',
    'icon' => null, // svg <path d="…"> data
    'tone' => 'primary', // primary | success | warning | accent
])
@php
    $tones = [
        'primary' => 'bg-primary-50 text-primary-600',
        'success' => 'bg-success-50 text-success-600',
        'warning' => 'bg-warning-50 text-warning-700',
        'accent'  => 'bg-accent-50 text-accent-600',
    ];
    $chip = $tones[$tone] ?? $tones['primary'];
@endphp
<div {{ $attributes->merge(['class' => 'rounded-2xl border border-line bg-white p-5 shadow-card']) }}>
    <div class="flex items-start justify-between gap-3">
        <div>
            <div class="text-[12.5px] font-medium text-ink-muted">{{ $label }}</div>
            <div class="mt-1.5 font-display text-3xl font-extrabold leading-none text-ink">{{ $value }}</div>
        </div>
        @if ($icon)
            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-xl {{ $chip }}">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
            </div>
        @endif
    </div>
    {{ $slot }}
</div>
