@extends('layouts.client')

@section('title', 'Mon devis')
@section('page_title', 'Mon devis')

@php
    $statusStyles = [
        'primary'   => 'text-primary-700 bg-primary-50 border-primary-200',
        'success'   => 'text-success-700 bg-success-50 border-success-200',
        'warning'   => 'text-warning-700 bg-warning-50 border-warning-200',
        'danger'    => 'text-accent-700 bg-accent-50 border-accent-100',
        'secondary' => 'text-ink-muted bg-line-subtle border-line',
        'info'      => 'text-primary-700 bg-primary-50 border-primary-200',
    ];
    $st = App\Http\Controllers\Controller::status($quote->status);
    $pill = $st ? ($statusStyles[$st['type']] ?? $statusStyles['secondary']) : $statusStyles['secondary'];
    $isPaid = (int) $quote->status === STATUT_PAID;
@endphp

@section('content')
    <div class="mx-auto max-w-2xl space-y-6">

        {{-- En-tête --}}
        <div>
            <a href="{{ route('list-quotes') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-ink-muted transition-colors hover:text-primary-600">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Mes devis
            </a>
            <div class="mt-3 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <span class="eyebrow">Devis</span>
                    <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">{{ $quote->reference ?: 'Demande de devis' }}</h2>
                </div>
                <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $pill }}">
                    {{ $st['message'] ?? '—' }}
                </span>
            </div>
        </div>

        {{-- Récapitulatif de la demande --}}
        <x-ui.card padding="p-0">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Détails de la demande</h3>
            </div>
            <dl class="px-6 py-2">
                <div class="flex items-center justify-between border-b border-line-subtle py-3">
                    <dt class="text-sm text-ink-muted">Patient</dt>
                    <dd class="text-sm font-semibold text-ink">{{ trim($quote->firstname . ' ' . $quote->lastname) ?: '—' }}</dd>
                </div>
                <div class="flex items-center justify-between border-b border-line-subtle py-3">
                    <dt class="text-sm text-ink-muted">Service</dt>
                    <dd class="text-sm font-semibold text-ink">{{ $service?->label ?? '—' }}</dd>
                </div>
                <div class="flex items-center justify-between py-3">
                    <dt class="text-sm text-ink-muted">Date de la demande</dt>
                    <dd class="text-sm font-semibold text-ink">{{ $quote->created_at?->format('d/m/Y') ?? '—' }}</dd>
                </div>
            </dl>
        </x-ui.card>

        {{-- Le devis --}}
        <x-ui.card padding="p-0">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Votre devis</h3>
            </div>
            <div class="px-6 py-5">
                @if ($quote->devis)
                    <a href="{{ route('files.quote', [$quote, 'devis']) }}" class="inline-flex items-center gap-2 rounded-lg border-[1.5px] border-primary-200 bg-primary-50 px-4 py-2.5 text-sm font-semibold text-primary-700 transition-colors hover:bg-primary-100">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Zm0 0v6h6"/></svg>
                        Télécharger le devis (PDF)
                    </a>
                    @if ($quote->response)
                        <div class="mt-4 rounded-lg border border-line bg-canvas px-4 py-3">
                            <div class="text-[11px] font-semibold uppercase tracking-wide text-ink-muted">Message de notre équipe</div>
                            <p class="mt-1 whitespace-pre-line text-sm text-ink">{{ $quote->response }}</p>
                        </div>
                    @endif
                @else
                    <div class="flex items-start gap-3 text-sm text-ink-muted">
                        <svg class="mt-0.5 h-5 w-5 flex-none text-warning-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v4m0 4h.01"/></svg>
                        <p>Votre devis sera disponible ici dès que votre demande aura été traitée par nos équipes. Vous serez notifié par e-mail.</p>
                    </div>
                @endif
            </div>
        </x-ui.card>

        {{-- Paiement des frais de service --}}
        <x-ui.card :featured="true" padding="p-0">
            <div class="border-b border-line px-6 py-5">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-[12.5px] font-medium text-ink-muted">Frais de service</div>
                        <div class="mt-0.5 font-display text-lg font-bold text-ink">{{ $service?->label ?? 'Relief Services' }}</div>
                    </div>
                    @if (!empty($quote->reference))
                        <span class="inline-flex items-center rounded-full border border-line bg-canvas px-3 py-1 font-mono text-[13px] font-semibold text-primary-600">{{ $quote->reference }}</span>
                    @endif
                </div>
            </div>

            @if ($isPaid)
                <div class="px-6 py-8 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-success-50 text-success-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    </div>
                    <div class="mt-3 font-display text-lg font-bold text-ink">Frais de service réglés</div>
                    <p class="mt-1 text-sm text-ink-muted">Merci, votre paiement a bien été reçu.</p>
                </div>
            @else
                <div class="px-6 py-8 text-center">
                    <div class="text-[12.5px] font-medium uppercase tracking-wide text-ink-muted">Montant à régler</div>
                    <div class="mt-2 font-display text-4xl font-extrabold leading-none text-ink">
                        {{ number_format($service?->price ?? 0, 0, ',', ' ') }} <span class="text-2xl text-ink-muted">XAF</span>
                    </div>
                </div>

                <div class="border-t border-line bg-canvas px-6 py-6">
                    <p class="text-center text-sm text-ink-muted">Réglez vos frais d'assistance pour la poursuite de votre procédure.</p>
                    <div class="mt-5 flex justify-center">
                        <x-ui.button variant="accent" href="{{ url('quote/pay/' . $quote->id) }}" class="w-full sm:w-auto">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h18M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/></svg>
                            Payer {{ number_format($service?->price ?? 0, 0, ',', ' ') }} XAF
                        </x-ui.button>
                    </div>
                    <p class="mt-4 flex items-center justify-center gap-1.5 text-xs text-ink-faint">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                        Paiement sécurisé
                    </p>
                </div>
            @endif
        </x-ui.card>

    </div>
@endsection
