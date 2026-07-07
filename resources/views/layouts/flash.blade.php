@php
    $flash = [
        'success' => session('success'),
        'error'   => session('error'),
        'warning' => session('warning'),
        'info'    => session('info'),
    ];
    $flashType = ['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'info'];
@endphp

@if (array_filter($flash) || $errors->any())
    <div class="mx-auto max-w-container px-4 pt-4 lg:px-6">
        @foreach ($flash as $key => $msg)
            @if ($msg)
                <x-ui.alert :type="$flashType[$key]" class="mb-3">{{ $msg }}</x-ui.alert>
            @endif
        @endforeach

        @if ($errors->any())
            <x-ui.alert type="danger" class="mb-3">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </x-ui.alert>
        @endif
    </div>
@endif
