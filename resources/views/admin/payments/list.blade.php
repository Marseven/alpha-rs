@extends('layouts.backoffice')

@section('title', 'Paiements')
@section('page_title', 'Paiements')

@php
    // Palette de badge (couleur uniquement) déduite du "type" bootstrap legacy ;
    // le libellé FR reste piloté par Controller::status()['message'].
    $badgeToneKey = [
        'primary'   => 'RECEIVED_BY_CNAMGS',
        'info'      => 'RECEIVED_BY_CNAMGS',
        'warning'   => 'IN_REVIEW',
        'success'   => 'READY',
        'danger'    => 'MISSING_INFORMATION',
        'secondary' => 'DRAFT',
    ];
@endphp

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div>
            <span class="eyebrow">Activité</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Paiements</h2>
            <p class="mt-1 text-sm text-ink-muted">Historique des transactions et des encaissements.</p>
        </div>

        {{-- KPIs --}}
        <div class="grid gap-5 sm:grid-cols-3">
            <x-ui.stat-card label="Total encaissé"
                :value="number_format((float) $payments->where('status', STATUT_PAID)->sum('amount'), 0, ',', ' ') . ' XAF'" tone="success"
                icon="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
            <x-ui.stat-card label="Montant total"
                :value="number_format((float) $payments->sum('amount'), 0, ',', ' ') . ' XAF'" tone="primary"
                icon="M3 10h18M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" />
            <x-ui.stat-card label="Transactions" :value="$payments->count()" tone="primary"
                icon="M4 4h6l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
        </div>

        {{-- Tableau --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des paiements</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[840px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Référence</th>
                            <th class="px-6 py-3 font-semibold">N° Produit</th>
                            <th class="px-6 py-3 font-semibold">Montant</th>
                            <th class="px-6 py-3 font-semibold">ID Transaction</th>
                            <th class="px-6 py-3 font-semibold">Opérateur</th>
                            <th class="px-6 py-3 font-semibold">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            @php
                                $status = \App\Http\Controllers\Controller::status($payment->status) ?? ['type' => 'secondary', 'message' => '—'];
                                $toneKey = $badgeToneKey[$status['type']] ?? 'DRAFT';
                            @endphp
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $payment->id }}</td>
                                <td class="px-6 py-3.5 font-mono text-[13px] text-primary-600">{{ $payment->reference }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $payment->refill->number_card ?? 'ACHAT' }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ number_format((float) $payment->amount, 0, ',', ' ') }} XAF</td>
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $payment->transaction_id }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $payment->operator }}</td>
                                <td class="px-6 py-3.5">
                                    <x-ui.badge :status="$toneKey" :label="$status['message']" />
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-10 text-center text-ink-muted">Aucun paiement pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
