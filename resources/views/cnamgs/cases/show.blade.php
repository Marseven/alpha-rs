@extends('layouts.medical')

@section('title', $case->tracking_number)
@section('page_title', 'Espace CNAMGS')

@php
    $statusLabels = [
        'draft' => 'Brouillon', 'sent_to_cnamgs' => 'Transmis CNAMGS',
        'received_by_cnamgs' => 'Reçu CNAMGS', 'in_review' => "En cours d'examen",
        'missing_information' => 'Pièce manquante', 'ready' => 'Prêt',
        'completed' => 'Terminé', 'cancelled' => 'Annulé',
    ];
    $steps = [
        ['key' => 'draft', 'label' => 'Brouillon'],
        ['key' => 'sent_to_cnamgs', 'label' => 'Transmis'],
        ['key' => 'received_by_cnamgs', 'label' => 'Reçu CNAMGS'],
        ['key' => 'in_review', 'label' => 'En examen'],
        ['key' => 'ready', 'label' => 'Prêt'],
        ['key' => 'completed', 'label' => 'Terminé'],
    ];
    $stepKeys = array_column($steps, 'key');
    $currentIndex = array_search($case->status, $stepKeys, true);
    if ($currentIndex === false) {
        $currentIndex = $case->status === 'missing_information'
            ? array_search('received_by_cnamgs', $stepKeys, true)
            : -1;
    }
@endphp

@section('content')
    <div class="mx-auto max-w-container">
        <a href="{{ route('cnamgs.cases') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600 hover:text-primary-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            Dossiers reçus
        </a>

        {{-- En-tête --}}
        <div class="mt-4 flex flex-wrap items-start justify-between gap-4">
            <div>
                <span class="eyebrow">Dossier de prise en charge</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">
                    <span class="font-mono text-primary-600">{{ $case->tracking_number }}</span>
                </h2>
                <p class="mt-1 text-sm text-ink-muted">{{ $case->patient_name }}</p>
            </div>
            <x-ui.badge :status="strtoupper($case->status)" class="mt-1 text-sm" />
        </div>

        @if ($case->status === 'missing_information')
            <x-ui.alert type="warning" class="mt-6">Ce dossier est en attente d'une pièce manquante.</x-ui.alert>
        @elseif ($case->status === 'cancelled')
            <x-ui.alert type="danger" class="mt-6">Ce dossier a été annulé.</x-ui.alert>
        @endif

        {{-- Timeline horizontale du workflow --}}
        <x-ui.card class="mt-6" padding="p-6">
            <h3 class="font-display text-base font-bold text-ink">Avancement du dossier</h3>
            <div class="mt-6 overflow-x-auto pb-2">
                <ol class="flex min-w-[640px] items-start">
                    @foreach ($steps as $i => $step)
                        @php
                            $state = $i < $currentIndex ? 'done' : ($i === $currentIndex ? 'current' : 'todo');
                        @endphp
                        <li class="relative flex flex-1 flex-col items-center text-center">
                            @unless ($loop->first)
                                <span class="absolute right-1/2 top-4 h-0.5 w-full {{ $i <= $currentIndex ? 'bg-success-600' : 'bg-line-strong' }}"></span>
                            @endunless
                            <span class="relative z-10 flex h-8 w-8 items-center justify-center rounded-full
                                @if ($state === 'done') bg-success-600 text-white
                                @elseif ($state === 'current') bg-white text-warning-700 ring-[3px] ring-warning-500 shadow-[0_0_0_5px_rgba(232,163,61,.18)]
                                @else bg-white text-ink-faint ring-2 ring-line-strong @endif">
                                @if ($state === 'done')
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                @else
                                    <span class="text-xs font-bold">{{ $i + 1 }}</span>
                                @endif
                            </span>
                            <span class="mt-2 px-1 text-xs font-semibold {{ $state === 'todo' ? 'text-ink-faint' : 'text-ink' }}">{{ $step['label'] }}</span>
                        </li>
                    @endforeach
                </ol>
            </div>
        </x-ui.card>

        <div class="mt-6 grid gap-6 lg:grid-cols-2">
            {{-- Informations patient / dossier --}}
            <x-ui.card padding="p-6">
                <h3 class="font-display text-base font-bold text-ink">Informations du dossier</h3>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between gap-4 border-b border-line-subtle pb-3">
                        <dt class="font-semibold text-ink">Patient</dt>
                        <dd class="text-right text-ink-muted">{{ $case->patient_name }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 border-b border-line-subtle pb-3">
                        <dt class="font-semibold text-ink">Téléphone</dt>
                        <dd class="text-right text-ink-muted">{{ $case->patient_phone ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 border-b border-line-subtle pb-3">
                        <dt class="font-semibold text-ink">Médecin</dt>
                        <dd class="text-right text-ink-muted">{{ $case->doctor?->name ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 {{ $case->doctor_note ? 'border-b border-line-subtle pb-3' : '' }}">
                        <dt class="font-semibold text-ink">Statut</dt>
                        <dd class="text-right text-ink-muted">{{ $statusLabels[$case->status] ?? $case->status }}</dd>
                    </div>
                    @if ($case->doctor_note)
                        <div>
                            <dt class="font-semibold text-ink">Note médecin</dt>
                            <dd class="mt-1 text-ink-muted">{{ $case->doctor_note }}</dd>
                        </div>
                    @endif
                </dl>

                @if ($case->folder && $case->folder->join_piece)
                    <div class="mt-5 border-t border-line pt-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-ink-muted">Documents</h4>
                        <a href="{{ route('files.folder', [$case->folder, 'piece']) }}" target="_blank" rel="noopener"
                           class="mt-2 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-primary-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Zm0 0v6h6"/></svg>
                            Pièce jointe du dossier
                        </a>
                    </div>
                @endif
            </x-ui.card>

            {{-- Action : mettre à jour le statut --}}
            <x-ui.card padding="p-6">
                <h3 class="font-display text-base font-bold text-ink">Mettre à jour le statut</h3>
                <p class="mt-1 text-sm text-ink-muted">Faites évoluer le dossier et laissez une note si nécessaire.</p>
                <form method="POST" action="{{ route('cnamgs.cases.status', $case) }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label for="status" class="mb-1.5 block text-sm font-semibold text-ink">Nouveau statut <span class="text-accent-600">*</span></label>
                        <select name="status" id="status" required
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @foreach (\App\Models\MedicalCaseWorkflow::CNAMGS_STATUSES as $s)
                                <option value="{{ $s }}" @selected(old('status', $case->status) === $s)>{{ $statusLabels[$s] ?? $s }}</option>
                            @endforeach
                        </select>
                        @error('status')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="cnamgs_note" class="mb-1.5 block text-sm font-semibold text-ink">Note (optionnel)</label>
                        <textarea name="cnamgs_note" id="cnamgs_note" rows="3"
                                  class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ old('cnamgs_note', $case->cnamgs_note) }}</textarea>
                        @error('cnamgs_note')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                    </div>
                    <x-ui.button type="submit" variant="primary" class="w-full">Enregistrer</x-ui.button>
                </form>
            </x-ui.card>
        </div>

        {{-- Historique --}}
        <x-ui.card class="mt-6" padding="p-6">
            <h3 class="font-display text-base font-bold text-ink">Historique des statuts</h3>
            <ul class="mt-4 space-y-3">
                @forelse ($case->statusHistories as $h)
                    <li class="flex flex-wrap items-center justify-between gap-2 border-b border-line-subtle pb-3 last:border-0 last:pb-0">
                        <span class="text-sm text-ink">
                            <span class="text-ink-muted">{{ $statusLabels[$h->old_status] ?? $h->old_status ?? '—' }}</span>
                            <span class="mx-1 text-ink-faint">→</span>
                            <span class="font-semibold">{{ $statusLabels[$h->new_status] ?? $h->new_status }}</span>
                            @if ($h->note)<span class="text-ink-muted">— {{ $h->note }}</span>@endif
                        </span>
                        <span class="font-mono text-xs text-ink-faint">{{ $h->created_at?->format('d/m/Y H:i') }}</span>
                    </li>
                @empty
                    <li class="text-sm text-ink-muted">Aucun historique.</li>
                @endforelse
            </ul>
        </x-ui.card>
    </div>
@endsection
