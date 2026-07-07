@extends('layouts.public')

@section('title', 'Paiement confirmé')

@section('content')
    @php $payment = $payment ?? null; @endphp

    <section class="bg-canvas">
        <div class="mx-auto max-w-2xl px-4 py-16 lg:py-20">
            <span class="eyebrow">Espace client · Paiement</span>
            <h1 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-4xl">Paiement confirmé</h1>
            <p class="mt-3 text-ink-muted">Votre paiement pour la demande de devis a bien été reçu. Un reçu récapitulatif est disponible ci-dessous.</p>

            @if (session('success'))
                <x-ui.alert type="success" class="mt-6">{{ session('success') }}</x-ui.alert>
            @endif

            <x-ui.card class="mt-6" padding="p-0">
                {{-- En-tête reçu --}}
                <div class="flex flex-col gap-4 border-b border-line p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-success-50 text-success-600">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div>
                            <div class="font-display text-lg font-bold text-ink">Devis N°{{ $quote->id }}</div>
                            <div class="font-mono text-[13px] text-primary-600">{{ $quote->reference }}</div>
                        </div>
                    </div>
                    <div class="sm:text-right">
                        <div class="text-sm font-semibold text-ink">{{ $quote->firstname }} {{ $quote->lastname }}</div>
                        <div class="text-sm text-ink-muted">{{ $quote->email }}</div>
                    </div>
                </div>

                {{-- Détails --}}
                <div class="grid gap-6 p-6 sm:grid-cols-3">
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">Date</div>
                        <div class="mt-1 text-sm font-semibold text-ink">{{ $quote->created_at }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">Référence</div>
                        <div class="mt-1 font-mono text-sm font-semibold text-ink">{{ $quote->reference }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">Statut</div>
                        <div class="mt-1"><x-ui.badge status="COMPLETED" label="Payé" /></div>
                    </div>
                </div>

                {{-- Ligne facturée --}}
                <div class="border-t border-line px-6 py-5">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-sm text-ink-muted">{{ $payment?->description ?? 'Demande de devis N°' . $quote->reference }}</span>
                        <span class="font-display text-lg font-bold text-ink">{{ $payment?->amount }} XAF</span>
                    </div>
                </div>

                {{-- Transaction --}}
                <div class="grid gap-6 border-t border-line bg-canvas p-6 sm:grid-cols-4">
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">Opérateur</div>
                        <div class="mt-1 text-sm font-semibold text-ink">{{ $payment?->operator ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">N° transaction</div>
                        <div class="mt-1 font-mono text-sm font-semibold text-ink">{{ $payment?->transaction_id ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">Payé le</div>
                        <div class="mt-1 text-sm font-semibold text-ink">{{ $payment?->paid_at ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-faint">Total</div>
                        <div class="mt-1 font-display text-base font-extrabold text-ink">{{ $payment?->amount }} XAF</div>
                    </div>
                </div>
            </x-ui.card>

            <div class="mt-6 flex flex-wrap gap-3">
                <x-ui.button variant="primary" href="{{ route('profil') }}">Retour à mon espace</x-ui.button>
                <button type="button" onclick="window.print();"
                    class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle">Imprimer le reçu</button>
            </div>
        </div>
    </section>
@endsection
