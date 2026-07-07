@extends('layouts.client')

@section('title', 'Paiement')
@section('page_title', 'Paiement des frais de service')

@section('content')
    <div class="mx-auto max-w-2xl">

        <div class="mb-6">
            <span class="eyebrow">Paiement</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Frais de service Relief Services</h2>
            <p class="mt-1 text-sm text-ink-muted">Réglez vos frais d'assistance pour la poursuite de votre procédure.</p>
        </div>

        <x-ui.card :featured="true" padding="p-0">
            <div class="border-b border-line px-6 py-5">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-[12.5px] font-medium text-ink-muted">Frais de service</div>
                        <div class="mt-0.5 font-display text-lg font-bold text-ink">{{ $service->label }}</div>
                    </div>
                    @if (!empty($quote->reference))
                        <span class="inline-flex items-center rounded-full border border-line bg-canvas px-3 py-1 font-mono text-[13px] font-semibold text-primary-600">{{ $quote->reference }}</span>
                    @endif
                </div>
            </div>

            <div class="px-6 py-8 text-center">
                <div class="text-[12.5px] font-medium uppercase tracking-wide text-ink-muted">Montant à régler</div>
                <div class="mt-2 font-display text-4xl font-extrabold leading-none text-ink">
                    {{ number_format($service->price, 0, ',', ' ') }} <span class="text-2xl text-ink-muted">XAF</span>
                </div>
            </div>

            <div class="border-t border-line bg-canvas px-6 py-6">
                <p class="text-center text-sm text-ink-muted">Procédez au règlement de vos frais d'assistance pour la suite de la procédure.</p>
                <div class="mt-5 flex justify-center">
                    <x-ui.button variant="accent" href="{{ url('quote/pay/' . $quote->id) }}" class="w-full sm:w-auto">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h18M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/></svg>
                        Payer {{ number_format($service->price, 0, ',', ' ') }} XAF
                    </x-ui.button>
                </div>
                <p class="mt-4 flex items-center justify-center gap-1.5 text-xs text-ink-faint">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                    Paiement sécurisé
                </p>
            </div>
        </x-ui.card>

    </div>
@endsection
