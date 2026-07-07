@extends('layouts.backoffice')

@section('title', 'Tableau de bord')
@section('page_title', 'Tableau de bord')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        <div>
            <span class="eyebrow">Vue d'ensemble</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Bienvenue sur l'administration</h2>
            <p class="mt-1 text-sm text-ink-muted">Suivi de l'activité, des dossiers et des paiements Relief Services.</p>
        </div>

        {{-- KPIs --}}
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <x-ui.stat-card label="Dossiers" :value="$folders" tone="primary"
                icon="M4 4h6l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
            <x-ui.stat-card label="Dossiers en attente" :value="$folders_pending ?? 0" tone="warning"
                icon="M12 6v6l4 2M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" />
            <x-ui.stat-card label="Dossiers traités" :value="$folders_end ?? 0" tone="success"
                icon="M22 11.08V12a10 10 0 1 1-5.93-9.14M22 4 12 14.01l-3-3" />
            <x-ui.stat-card label="Hôpitaux partenaires" :value="$hospitals" tone="primary"
                icon="M12 6v4m-2-2h4M4 21V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16M2 21h20" />
        </div>

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <x-ui.stat-card label="Total encaissé" :value="number_format((float) $payment_pay, 0, ',', ' ') . ' XAF'" tone="success"
                icon="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
            <x-ui.stat-card label="Montant total" :value="number_format((float) $payment_total, 0, ',', ' ') . ' XAF'" tone="primary"
                icon="M3 10h18M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" />
            <x-ui.stat-card label="Pays de destination" :value="$countries" tone="primary"
                icon="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20ZM2 12h20M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20Z" />
            <x-ui.stat-card label="Utilisateurs" :value="$users" tone="primary"
                icon="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
        </div>

        {{-- Derniers devis --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Derniers devis</h3>
                <a href="{{ url('admin/list-quotes') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Tout voir →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">Référence</th>
                            <th class="px-6 py-3 font-semibold">Client</th>
                            <th class="px-6 py-3 font-semibold">Service</th>
                            <th class="px-6 py-3 font-semibold">Destination</th>
                            <th class="px-6 py-3 font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quotes as $quote)
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-primary-600">{{ $quote->reference }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $quote->firstname }} {{ $quote->lastname }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $quote->service->label ?? '—' }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $quote->country->label ?? '—' }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $quote->created_at?->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-ink-muted">Aucun devis pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
