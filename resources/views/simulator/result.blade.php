@extends('layouts.public')

@section('title', 'Résultat de la simulation')

@php
    $currency = $simulation->currency ?? 'XAF';
    $fmt = fn ($n) => number_format((float) $n, 0, ',', ' ');
    $lines = $simulation->lines;
    $mandatory = $lines->where('is_optional', false);
    $optional = $lines->where('is_optional', true);
    $grouped = $mandatory->groupBy(fn ($l) => $l->category ?: 'Prestations');
    $optionsTotal = $optional->sum('amount');
@endphp

@section('content')

    {{-- ================= RÉCAPITULATIF ================= --}}
    <section class="bg-gradient-to-b from-primary-50/60 to-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Résultat de la simulation</span>
                <h1 class="mt-3 font-display text-4xl font-extrabold leading-[1.12] tracking-tight text-ink sm:text-5xl">
                    Votre estimation de prise en charge
                </h1>
                <p class="mx-auto mt-4 max-w-xl text-lg leading-relaxed text-ink-muted">
                    Référence <span class="font-mono font-semibold text-primary-600">{{ $simulation->reference }}</span> —
                    estimation indicative, susceptible d'évoluer après analyse médicale.
                </p>
            </div>

            <div class="mx-auto mt-10 grid max-w-3xl gap-4 sm:grid-cols-3">
                <x-ui.card padding="p-5">
                    <div class="eyebrow text-primary-400">Destination</div>
                    <div class="mt-2 font-display text-xl font-extrabold text-ink">{{ $simulation->country?->label ?? '—' }}</div>
                </x-ui.card>
                <x-ui.card padding="p-5">
                    <div class="eyebrow text-primary-400">Service</div>
                    <div class="mt-2 font-display text-xl font-extrabold text-ink">{{ $simulation->service?->label ?? '—' }}</div>
                </x-ui.card>
                <x-ui.card padding="p-5">
                    <div class="eyebrow text-primary-400">Pathologie</div>
                    <div class="mt-2 font-display text-xl font-extrabold text-ink">{{ $simulation->sick?->label ?? '—' }}</div>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- ================= DÉTAIL / VENTILATION ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mx-auto max-w-3xl">

                @if ($lines->count() > 0)
                    {{-- Estimation globale --}}
                    <div class="rounded-2xl border border-primary-100 bg-primary-50/50 p-6 text-center sm:p-8">
                        <div class="eyebrow text-primary-500">Estimation globale</div>
                        <div class="mt-2 font-display text-4xl font-extrabold text-primary-700 sm:text-5xl">
                            {{ $fmt($simulation->total) }} <span class="text-2xl text-ink-muted">{{ $currency }}</span>
                        </div>
                        @if ($optionsTotal > 0)
                            <p class="mt-2 text-sm text-ink-muted">+ {{ $fmt($optionsTotal) }} {{ $currency }} d'options facultatives (voir ci-dessous)</p>
                        @endif
                    </div>

                    {{-- Détail par catégorie --}}
                    <div class="mt-8 overflow-hidden rounded-2xl border border-line bg-white shadow-card">
                        <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                                    <th class="px-5 py-3 font-semibold">Poste</th>
                                    <th class="px-5 py-3 text-right font-semibold">Qté</th>
                                    <th class="px-5 py-3 text-right font-semibold">Prix unitaire</th>
                                    <th class="px-5 py-3 text-right font-semibold">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grouped as $category => $catLines)
                                    <tr class="bg-primary-50/30">
                                        <td colspan="4" class="px-5 py-2 font-display text-xs font-bold uppercase tracking-wide text-primary-700">{{ $category }}</td>
                                    </tr>
                                    @foreach ($catLines as $line)
                                        <tr class="border-b border-line-subtle last:border-0">
                                            <td class="px-5 py-3 text-ink">
                                                {{ $line->label }}
                                                @if ($line->is_estimate)<span class="ml-1.5 rounded-full bg-warning-50 px-1.5 py-0.5 text-[10px] font-bold uppercase text-warning-600">estimé</span>@endif
                                            </td>
                                            <td class="px-5 py-3 text-right font-mono text-ink-muted">{{ rtrim(rtrim(number_format($line->quantity, 2, ',', ' '), '0'), ',') }}</td>
                                            <td class="px-5 py-3 text-right font-mono text-ink-muted">{{ $fmt($line->unit_price) }}</td>
                                            <td class="px-5 py-3 text-right font-mono font-semibold text-ink">{{ $fmt($line->amount) }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr class="border-t-2 border-line bg-canvas">
                                    <td colspan="3" class="px-5 py-3 text-right font-display font-bold text-ink">Total estimé</td>
                                    <td class="px-5 py-3 text-right font-display text-lg font-extrabold text-primary-700">{{ $fmt($simulation->total) }} {{ $currency }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    {{-- Options facultatives --}}
                    @if ($optional->count() > 0)
                        <div class="mt-6 rounded-2xl border border-line bg-white p-5 shadow-card">
                            <h3 class="font-display text-sm font-bold text-ink">Prestations facultatives (non incluses dans le total)</h3>
                            <ul class="mt-3 space-y-2">
                                @foreach ($optional as $line)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="text-ink-muted">{{ $line->label }}</span>
                                        <span class="font-mono text-ink">{{ $fmt($line->amount) }} {{ $currency }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p class="mt-6 text-center text-xs text-ink-faint">
                        Tarifs {{ $simulation->tariff_version }} · valable jusqu'au {{ $simulation->valid_until?->format('d/m/Y') ?? '—' }} ·
                        montants indicatifs, l'estimation définitive est établie après analyse médicale du dossier.
                    </p>
                @else
                    <x-ui.card padding="p-8" class="text-center">
                        <h3 class="font-display text-lg font-bold text-ink">Aucun tarif configuré pour ces critères</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-ink-muted">
                            Nous n'avons pas encore de grille pour cette combinaison. Demandez un devis pour une évaluation personnalisée.
                        </p>
                    </x-ui.card>
                @endif

                {{-- CTA --}}
                <div class="mt-10 rounded-2xl border border-line bg-white p-8 text-center shadow-card">
                    <h3 class="font-display text-2xl font-extrabold text-ink">Besoin d'une évaluation détaillée ?</h3>
                    <p class="mx-auto mt-3 max-w-xl text-ink-muted">Demandez un devis personnalisé pour connaître précisément votre prise en charge.</p>
                    <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <x-ui.button variant="accent" href="{{ url('quote') }}">Demander un devis</x-ui.button>
                        <x-ui.button variant="outline" href="{{ route('simulator') }}">Nouvelle simulation</x-ui.button>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
