@extends('layouts.default')

@section('content')
    <section class="section" style="padding:60px 0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h1 class="heading-font mb-3">Suivre mon dossier</h1>
                    <p class="text-muted mb-4">Saisissez votre numéro de suivi et votre téléphone pour connaître l'état de votre dossier.</p>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">
                            @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul></div>
                    @endif

                    @isset($result)
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="mb-3">Dossier <code>{{ $result['tracking_number'] }}</code></h5>
                                <p class="mb-1"><strong>Patient :</strong> {{ $result['patient_name'] }}</p>
                                <p class="mb-1"><strong>Statut :</strong> {{ $result['status_label'] }}</p>
                                <p class="mb-0 text-muted"><small>Dernière mise à jour : {{ $result['updated_at']?->format('d/m/Y H:i') }}</small></p>
                            </div>
                        </div>
                    @endisset

                    <form method="POST" action="{{ route('track.track') }}" class="card shadow-sm">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Numéro de suivi</label>
                                <input type="text" name="tracking_number" class="form-control"
                                       value="{{ old('tracking_number') }}" placeholder="RS-XXXXXX" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="phone" class="form-control" placeholder="0XXXXXXXX" required>
                            </div>
                            <button class="btn btn-4">Vérifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
