@extends('layouts.medical')

@section('title', 'Dossiers reçus')
@section('page_title', 'Espace CNAMGS')

@section('content')
    <div class="mx-auto max-w-container">
        <div class="mb-6">
            <span class="eyebrow">Workflow CNAMGS</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Dossiers reçus pour traitement</h2>
            <p class="mt-1 text-sm text-ink-muted">Examinez les dossiers transmis par les médecins et faites évoluer leur statut.</p>
        </div>

        <x-ui.card padding="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-[#F9FBFD] text-[11.5px] uppercase tracking-wider text-ink-muted">
                            <th class="px-5 py-3 font-semibold">Suivi</th>
                            <th class="px-5 py-3 font-semibold">Patient</th>
                            <th class="px-5 py-3 font-semibold">Médecin</th>
                            <th class="px-5 py-3 font-semibold">Statut</th>
                            <th class="px-5 py-3 font-semibold">Reçu le</th>
                            <th class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cases as $case)
                            <tr class="border-b border-line-subtle transition-colors last:border-0 hover:bg-[#F7FAFD]">
                                <td class="px-5 py-4">
                                    <span class="font-mono text-[13px] font-semibold text-primary-600">{{ $case->tracking_number }}</span>
                                </td>
                                <td class="px-5 py-4 font-semibold text-ink">{{ $case->patient_name }}</td>
                                <td class="px-5 py-4 text-ink-muted">{{ $case->doctor?->name ?? '—' }}</td>
                                <td class="px-5 py-4"><x-ui.badge :status="strtoupper($case->status)" /></td>
                                <td class="px-5 py-4 text-ink-muted">{{ $case->received_by_cnamgs_at?->format('d/m/Y H:i') ?? $case->sent_to_cnamgs_at?->format('d/m/Y H:i') ?? '—' }}</td>
                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('cnamgs.cases.show', $case) }}"
                                       class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600 hover:text-primary-700">
                                        Traiter
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-ink-muted">Aucun dossier reçu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        @if ($cases->hasPages())
            <div class="mt-6">{{ $cases->links() }}</div>
        @endif
    </div>
@endsection
