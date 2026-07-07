@props([
    'featured' => false,
    'padding' => 'p-6',
])
<div {{ $attributes->merge(['class' => 'rounded-2xl border border-line bg-white shadow-card ' . ($featured ? 'border-t-[3px] border-t-accent-600 ' : '') . $padding]) }}>
    {{ $slot }}
</div>
