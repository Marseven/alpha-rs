@extends('layouts.backoffice')

@section('title', 'Dossiers médicaux')
@section('page_title', 'Dossiers médicaux')

@php
    $statusLabels = [
        'draft' => 'Brouillon', 'sent_to_cnamgs' => 'Transmis', 'received_by_cnamgs' => 'Reçu CNAMGS',
        'in_review' => 'En examen', 'missing_information' => 'Pièce manquante', 'ready' => 'Prêt',
        'completed' => 'Terminé', 'cancelled' => 'Annulé',
    ];
@endphp

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div>
            <span class="eyebrow">Back-office</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Dossiers médicaux</h2>
            <p class="mt-1 text-sm text-ink-muted">Affectez un dossier à un médecin et fixez une date limite de traitement.</p>
        </div>

        @include('layouts.flash')

        <div class="rounded-2xl border border-line bg-white shadow-card">
            @if ($cases->count())
                <div class="overflow-x-auto">
                    <table data-datatable class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                                <th class="px-6 py-3 font-semibold">Suivi</th>
                                <th class="px-6 py-3 font-semibold">Patient</th>
                                <th class="px-6 py-3 font-semibold">Médecin</th>
                                <th class="px-6 py-3 font-semibold">Statut</th>
                                <th class="px-6 py-3 font-semibold">Échéance</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cases as $case)
                                <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                    <td class="px-6 py-3.5 font-mono text-[13px] font-semibold text-primary-600">{{ $case->tracking_number }}</td>
                                    <td class="px-6 py-3.5 font-medium text-ink">{{ $case->patient_name }}</td>
                                    <td class="px-6 py-3.5 text-ink-muted">{{ $case->doctor->name ?? '— non affecté —' }}</td>
                                    <td class="px-6 py-3.5">
                                        <span class="inline-flex items-center rounded-full border border-line bg-canvas px-3 py-1 text-xs font-bold text-ink-muted">{{ $statusLabels[$case->status] ?? $case->status }}</span>
                                    </td>
                                    <td class="px-6 py-3.5">
                                        @if ($case->due_at)
                                            <span class="inline-flex items-center gap-1.5 text-sm {{ $case->isOverdue() ? 'font-bold text-accent-700' : 'text-ink-muted' }}">
                                                {{ $case->due_at->format('d/m/Y') }}
                                                @if ($case->isOverdue())
                                                    <span class="rounded-full bg-accent-50 px-2 py-0.5 text-[11px] font-bold text-accent-700">En retard</span>
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-ink-faint">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3.5 text-right">
                                        <a href="#assign-{{ $case->id }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Affecter</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-16 text-center text-ink-muted">Aucun dossier médical pour le moment.</div>
            @endif
        </div>

        {{-- Panneaux d'affectation (accordéon CSS :target, sans JS) --}}
        @foreach ($cases as $case)
            <div id="assign-{{ $case->id }}" class="hidden rounded-2xl border border-line bg-white p-6 shadow-card [&:target]:block">
                <div class="flex items-center justify-between">
                    <h3 class="font-display text-base font-bold text-ink">Affecter — {{ $case->tracking_number }} · {{ $case->patient_name }}</h3>
                    <a href="#" class="text-sm text-ink-faint hover:text-ink">Fermer</a>
                </div>

                @if ($case->isTerminal())
                    <x-ui.alert type="info" class="mt-4">Ce dossier est clôturé ({{ $statusLabels[$case->status] ?? $case->status }}) et ne peut plus être affecté.</x-ui.alert>
                @else
                    <form method="POST" action="{{ route('admin.medical-cases.assign', $case) }}" class="mt-4 grid gap-4 sm:grid-cols-2">
                        @csrf
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-ink">Médecin <span class="text-accent-600">*</span></label>
                            <select name="doctor_id" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                <option value="">— Choisir —</option>
                                @foreach ($doctors as $d)
                                    <option value="{{ $d->id }}" @selected($case->doctor_id == $d->id)>{{ $d->name }}@if($d->specialty) — {{ $d->specialty }}@endif</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-ink">Date limite</label>
                            <input type="date" name="due_at" value="{{ $case->due_at?->format('Y-m-d') }}"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-semibold text-ink">Motif @if($case->doctor_id)<span class="text-accent-600">*</span> (réaffectation)@endif</label>
                            <input type="text" name="reason" value="{{ old('reason') }}" maxlength="500"
                                   placeholder="{{ $case->doctor_id ? 'Obligatoire pour réaffecter' : 'Optionnel' }}"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('reason')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <x-ui.button type="submit" variant="primary">{{ $case->doctor_id ? 'Réaffecter' : 'Affecter' }}</x-ui.button>
                        </div>
                    </form>
                @endif
            </div>
        @endforeach

    </div>
@endsection
