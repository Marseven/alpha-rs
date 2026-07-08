@extends('layouts.public')

@section('title', 'Suivre mon dossier')
@section('meta_description', "Suivez l'état de votre dossier de prise en charge Relief Services avec votre numéro de suivi et votre téléphone.")

@section('content')
    <section class="bg-canvas">
        <div class="mx-auto max-w-2xl px-4 py-16 lg:py-20">
            <span class="eyebrow">Suivi de dossier</span>
            <h1 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-4xl">Suivre mon dossier</h1>
            <p class="mt-3 text-ink-muted">Saisissez votre numéro de suivi et votre téléphone pour connaître l'état de votre prise en charge.</p>

            @if (session('error'))
                <x-ui.alert type="danger" class="mt-6">{{ session('error') }}</x-ui.alert>
            @endif
            @if ($errors->any())
                <x-ui.alert type="danger" class="mt-6">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </x-ui.alert>
            @endif

            @isset($result)
                <x-ui.card class="mt-6" padding="p-6">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="font-display text-lg font-bold text-ink">Dossier <span class="font-mono text-primary-600">{{ $result['tracking_number'] }}</span></h2>
                        <x-ui.badge :status="$result['status'] ?? null" :label="$result['status_label'] ?? null" />
                    </div>
                    <dl class="mt-4 space-y-2 text-sm">
                        <div class="flex gap-2"><dt class="font-semibold text-ink">Patient :</dt><dd class="text-ink-muted">{{ $result['patient_name'] }}</dd></div>
                        <div class="flex gap-2"><dt class="font-semibold text-ink">Statut :</dt><dd class="text-ink-muted">{{ $result['status_label'] }}</dd></div>
                    </dl>
                    <p class="mt-3 text-xs text-ink-faint">Dernière mise à jour : {{ $result['updated_at']?->format('d/m/Y H:i') }}</p>
                </x-ui.card>
            @endisset

            <form method="POST" action="{{ route('track.track') }}" class="mt-6">
                @csrf
                <x-ui.card padding="p-6">
                    <div class="space-y-4">
                        <div>
                            <label for="tracking_number" class="mb-1.5 block text-sm font-semibold text-ink">Numéro de suivi</label>
                            <input type="text" id="tracking_number" name="tracking_number" value="{{ old('tracking_number') }}" placeholder="RS-XXXXXX" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 font-mono text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        </div>
                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                            <input type="text" id="phone" name="phone" placeholder="0XXXXXXXX" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        </div>
                        <x-ui.button type="submit" variant="primary" class="w-full">Vérifier mon dossier</x-ui.button>
                    </div>
                </x-ui.card>
            </form>
        </div>
    </section>
@endsection
