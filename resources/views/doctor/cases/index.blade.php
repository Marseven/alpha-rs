@extends('layouts.panel')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Suivi</th><th>Patient</th><th>Téléphone</th>
                        <th>Statut</th><th>CNAMGS</th><th>Mise à jour</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr>
                            <td><code>{{ $case->tracking_number }}</code></td>
                            <td>{{ $case->patient_name }}</td>
                            <td>{{ $case->patient_phone }}</td>
                            <td><span class="badge bg-secondary">{{ $case->status }}</span></td>
                            <td>{{ $case->pharmacy?->name ?? '—' }}</td>
                            <td>{{ $case->updated_at?->format('d/m/Y H:i') }}</td>
                            <td><a class="btn btn-sm btn-primary" href="{{ route('doctor.cases.show', $case) }}">Ouvrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">Aucun dossier assigné.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $cases->links() }}
        </div>
    </div>
@endsection
