@extends('layouts.public')

@section('title', 'Résultat de la simulation')

@section('content')

    {{-- ================= HERO / RÉCAPITULATIF ================= --}}
    <section class="bg-gradient-to-b from-primary-50/60 to-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Résultat de la simulation</span>
                <h1 class="mt-3 font-display text-4xl font-extrabold leading-[1.12] tracking-tight text-ink sm:text-5xl">
                    Votre estimation de prise en charge
                </h1>
                <p class="mx-auto mt-4 max-w-xl text-lg leading-relaxed text-ink-muted">
                    Voici les montants indicatifs correspondant aux critères sélectionnés.
                </p>
            </div>

            {{-- Récapitulatif des critères --}}
            <div class="mx-auto mt-10 grid max-w-3xl gap-4 sm:grid-cols-3">
                <x-ui.card padding="p-5">
                    <div class="eyebrow text-primary-400">Destination</div>
                    <div class="mt-2 font-display text-xl font-extrabold text-ink">{{ $country_id->label }}</div>
                </x-ui.card>
                <x-ui.card padding="p-5">
                    <div class="eyebrow text-primary-400">Service</div>
                    <div class="mt-2 font-display text-xl font-extrabold text-ink">{{ $service_id->label }}</div>
                </x-ui.card>
                <x-ui.card padding="p-5">
                    <div class="eyebrow text-primary-400">Frais de service</div>
                    <div class="mt-2 flex items-baseline gap-1.5">
                        <span class="font-display text-xl font-extrabold text-ink">{{ number_format($service_id->price, 0, ',', ' ') }}</span>
                        <span class="font-mono text-sm text-ink-muted">XAF</span>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- ================= DÉTAIL DES MONTANTS ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 flex flex-wrap items-end justify-between gap-4">
                <div class="max-w-2xl">
                    <span class="eyebrow">Détail de l'estimation</span>
                    <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Montants pris en charge</h2>
                    <p class="mt-3 text-ink-muted">Pathologie concernée : <strong class="font-semibold text-ink">{{ $sick_id->label }}</strong>.</p>
                </div>
            </div>

            @if ($simulators->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($simulators as $simulator)
                        @php
                            $simulator->load(['item']);
                        @endphp
                        <x-ui.card padding="p-6" class="flex flex-col">
                            <h3 class="font-display text-lg font-bold text-ink">{{ $simulator->item?->label }}</h3>
                            <div class="mt-3 font-display text-3xl font-extrabold text-primary-600">{{ $simulator->value }}</div>
                            @if ($simulator->note)
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-ink-muted">{{ $simulator->note }}</p>
                            @endif
                        </x-ui.card>
                    @endforeach
                </div>
            @else
                <x-ui.card padding="p-8" class="text-center">
                    <h3 class="font-display text-lg font-bold text-ink">Aucun élément pour le moment</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-ink-muted">
                        Aucune estimation ne correspond à ces critères. Demandez un devis pour une évaluation personnalisée.
                    </p>
                </x-ui.card>
            @endif

            {{-- CTA --}}
            <div class="mt-12 rounded-2xl border border-line bg-white p-8 text-center shadow-card sm:p-10">
                <h3 class="font-display text-2xl font-extrabold text-ink">Besoin d'une évaluation détaillée ?</h3>
                <p class="mx-auto mt-3 max-w-xl text-ink-muted">
                    Ces montants sont indicatifs. Demandez un devis personnalisé pour connaître précisément votre prise en charge.
                </p>
                <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <x-ui.button variant="accent" href="{{ url('quote') }}">Demander un devis</x-ui.button>
                    <x-ui.button variant="outline" href="{{ route('simulator') }}">Nouvelle simulation</x-ui.button>
                </div>
            </div>
        </div>
    </section>

@endsection
