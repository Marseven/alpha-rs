@extends('layouts.client')

@section('title', $title ?? 'Dossier')
@section('page_title', $case->exists ? 'Modifier le dossier' : 'Nouveau dossier')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('doctor.cases') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-ink-muted hover:text-primary-600">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Mes dossiers
        </a>

        <div class="mb-6">
            <span class="eyebrow">Dossier médical</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">{{ $case->exists ? 'Modifier le dossier' : 'Enregistrer un nouveau dossier' }}</h2>
            @if ($case->exists)
                <p class="mt-1 font-mono text-sm text-primary-600">{{ $case->tracking_number }}</p>
            @endif
        </div>

        <form method="POST" action="{{ $case->exists ? route('doctor.cases.update', $case) : route('doctor.cases.store') }}">
            @csrf
            @if ($case->exists)
                @method('PUT')
            @endif

            <x-ui.card padding="p-6">
                <div class="space-y-4">
                    <div>
                        <label for="patient_name" class="mb-1.5 block text-sm font-semibold text-ink">Nom du patient <span class="text-accent-600">*</span></label>
                        <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name', $case->patient_name) }}" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('patient_name')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="patient_phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone du patient <span class="text-accent-600">*</span></label>
                        <input type="text" id="patient_phone" name="patient_phone" value="{{ old('patient_phone', $case->patient_phone) }}" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('patient_phone')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="doctor_note" class="mb-1.5 block text-sm font-semibold text-ink">Note médicale <span class="text-ink-faint">(optionnel)</span></label>
                        <textarea id="doctor_note" name="doctor_note" rows="4"
                                  class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ old('doctor_note', $case->doctor_note) }}</textarea>
                        @error('doctor_note')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <x-ui.button type="submit" variant="accent">{{ $case->exists ? 'Enregistrer les modifications' : 'Créer le dossier' }}</x-ui.button>
                        <x-ui.button variant="ghost" href="{{ $case->exists ? route('doctor.cases.show', $case) : route('doctor.cases') }}">Annuler</x-ui.button>
                    </div>
                </div>
            </x-ui.card>
        </form>
    </div>
@endsection
