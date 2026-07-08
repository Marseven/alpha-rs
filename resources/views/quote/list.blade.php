@extends('layouts.client')

@section('title', 'Mes devis')
@section('page_title', 'Mes devis')

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
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Mes devis</h2>
                <p class="mt-1 text-sm text-ink-muted">Suivez vos demandes de devis et réglez-les en ligne.</p>
            </div>
            <a href="{{ route('quote') }}"><x-ui.button variant="accent">Nouvelle demande</x-ui.button></a>
        </div>

        <div class="rounded-2xl border border-line bg-white shadow-card">
            @if ($quotes->count())
                <div class="overflow-x-auto">
                    <table data-datatable class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                                <th class="px-6 py-3 font-semibold">Référence</th>
                                <th class="px-6 py-3 font-semibold">Demandeur</th>
                                <th class="px-6 py-3 font-semibold">Service</th>
                                <th class="px-6 py-3 font-semibold">Date</th>
                                <th class="px-6 py-3 font-semibold">Statut</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotes as $quote)
                                @php
                                    $st = App\Http\Controllers\Controller::status($quote->status);
                                    $pill = $st ? ($statusStyles[$st['type']] ?? $statusStyles['secondary']) : $statusStyles['secondary'];
                                @endphp
                                <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                    <td class="px-6 py-3.5 font-mono text-[13px] font-semibold text-primary-600">{{ $quote->reference }}</td>
                                    <td class="px-6 py-3.5 font-medium text-ink">{{ trim($quote->firstname . ' ' . $quote->lastname) ?: '—' }}</td>
                                    <td class="px-6 py-3.5 text-ink-muted">{{ $quote->service->label ?? '—' }}</td>
                                    <td class="px-6 py-3.5 text-ink-muted">{{ $quote->created_at?->format('d/m/Y') }}</td>
                                    <td class="px-6 py-3.5">
                                        <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $pill }}">
                                            {{ $st['message'] ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3.5 text-right">
                                        <a href="{{ url('quote/pay/' . $quote->id) }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600 hover:text-primary-700">
                                            Payer
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Zm0 0v6h6"/></svg>
                    </div>
                    <h3 class="mt-4 font-display text-lg font-bold text-ink">Aucun devis pour le moment</h3>
                    <p class="mt-1 max-w-sm text-sm text-ink-muted">Vos demandes de devis apparaîtront ici. Lancez-en une pour commencer.</p>
                    <a href="{{ route('quote') }}" class="mt-5"><x-ui.button variant="primary">Demander un devis</x-ui.button></a>
                </div>
            @endif
        </div>

    </div>
@endsection
