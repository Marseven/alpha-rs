@extends('layouts.panel')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Suivi</th><th>Patient</th><th>Médecin</th>
                        <th>Statut</th><th>Reçu le</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr>
                            <td><code>{{ $case->tracking_number }}</code></td>
                            <td>{{ $case->patient_name }}</td>
                            <td>{{ $case->doctor?->name ?? '—' }}</td>
                            <td><span class="badge bg-secondary">{{ $case->status }}</span></td>
                            <td>{{ $case->received_by_pharmacy_at?->format('d/m/Y H:i') ?? $case->sent_to_pharmacy_at?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td><a class="btn btn-sm btn-primary" href="{{ route('pharmacy.cases.show', $case) }}">Traiter</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">Aucun dossier reçu.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $cases->links() }}
        </div>
    </div>
@endsection
