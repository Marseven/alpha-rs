@extends('layouts.client')

@section('title', 'Mes paiements')
@section('page_title', 'Mes paiements')

@php
    $statusStyles = [
        'primary'   => 'text-primary-700 bg-primary-50 border-primary-200',
        'success'   => 'text-success-700 bg-success-50 border-success-200',
        'warning'   => 'text-warning-700 bg-warning-50 border-warning-200',
        'danger'    => 'text-accent-700 bg-accent-50 border-accent-100',
        'secondary' => 'text-ink-muted bg-line-subtle border-line',
        'info'      => 'text-primary-700 bg-primary-50 border-primary-200',
    ];
@endphp

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <span class="eyebrow">Espace client</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Mes paiements</h2>
                <p class="mt-1 text-sm text-ink-muted">Historique de vos règlements de frais de service.</p>
            </div>
            @if ($payments->count())
                <span class="inline-flex items-center gap-2 rounded-full border border-line bg-white px-3.5 py-1.5 text-sm font-semibold text-ink-muted shadow-card">
                    <span class="font-display text-base font-extrabold text-ink">{{ $payments->count() }}</span>
                    paiement{{ $payments->count() > 1 ? 's' : '' }}
                </span>
            @endif
        </div>

        <div class="rounded-2xl border border-line bg-white shadow-card">
            @if ($payments->count())
                <div class="overflow-x-auto">
                    <table data-datatable class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                                <th class="px-6 py-3 font-semibold">Référence</th>
                                <th class="px-6 py-3 font-semibold">Date</th>
                                <th class="px-6 py-3 font-semibold">Montant</th>
                                <th class="px-6 py-3 font-semibold">Transaction</th>
                                <th class="px-6 py-3 font-semibold">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                @php
                                    $st = App\Http\Controllers\Controller::status($payment->status);
                                    $pill = $st ? ($statusStyles[$st['type']] ?? $statusStyles['secondary']) : $statusStyles['secondary'];
                                @endphp
                                <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                    <td class="px-6 py-3.5 font-mono text-[13px] font-semibold text-primary-600">{{ $payment->reference }}</td>
                                    <td class="px-6 py-3.5 text-ink-muted">{{ $payment->created_at?->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-3.5 font-medium text-ink">{{ number_format((float) $payment->amount, 0, ',', ' ') }} XAF</td>
                                    <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $payment->transaction_id ?: '—' }}</td>
                                    <td class="px-6 py-3.5">
                                        <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $pill }}">
                                            {{ $st['message'] ?? $payment->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h18M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/></svg>
                    </div>
                    <h3 class="mt-4 font-display text-lg font-bold text-ink">Aucun paiement pour le moment</h3>
                    <p class="mt-1 max-w-sm text-sm text-ink-muted">Vos règlements de frais de service apparaîtront ici une fois effectués.</p>
                </div>
            @endif
        </div>

    </div>
@endsection
