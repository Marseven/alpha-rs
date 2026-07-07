@props(['value', 'label'])
<div class="flex flex-col gap-1">
    <div class="font-display text-4xl font-extrabold leading-none text-ink">{{ $value }}</div>
    <div class="text-sm text-ink-muted">{{ $label }}</div>
</div>
