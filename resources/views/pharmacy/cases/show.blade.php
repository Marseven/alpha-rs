@extends('layouts.panel')

@section('content')
    <a href="{{ route('pharmacy.cases') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Dossiers reçus</a>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Dossier <code>{{ $case->tracking_number }}</code></div>
                <div class="card-body">
                    <p><strong>Patient :</strong> {{ $case->patient_name }}</p>
                    <p><strong>Téléphone :</strong> {{ $case->patient_phone ?? '—' }}</p>
                    <p><strong>Médecin :</strong> {{ $case->doctor?->name ?? '—' }}</p>
                    <p><strong>Statut :</strong> <span class="badge bg-secondary">{{ $case->status }}</span></p>
                    @if ($case->doctor_note)<p><strong>Note médecin :</strong> {{ $case->doctor_note }}</p>@endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Mettre à jour le statut</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pharmacy.cases.status', $case) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nouveau statut</label>
                            <select name="status" class="form-select" required>
                                @foreach (\App\Models\MedicalCaseWorkflow::PHARMACY_STATUSES as $s)
                                    <option value="{{ $s }}" @selected($case->status === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note (optionnel)</label>
                            <textarea name="pharmacy_note" class="form-control" rows="3">{{ $case->pharmacy_note }}</textarea>
                        </div>
                        <button class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header">Historique des statuts</div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse ($case->statusHistories as $h)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $h->old_status ?? '—' }} → <strong>{{ $h->new_status }}</strong>
                            @if($h->note)<span class="text-muted">— {{ $h->note }}</span>@endif</span>
                        <span class="text-muted small">{{ $h->created_at?->format('d/m/Y H:i') }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucun historique.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
