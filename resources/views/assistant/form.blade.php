@extends('layouts.default')

@section('content')
    <section class="section" style="padding:60px 0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h1 class="heading-font mb-2">Vous avez une question ?</h1>
                    <p class="text-muted mb-4">Posez votre question à l'assistant {{ config('relief.name') }}.
                        <br><small>{{ config('relief.medical_disclaimer') }}</small></p>

                    @if ($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">
                            @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul></div>
                    @endif

                    @isset($answer)
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <p class="text-muted mb-1"><small>Votre question :</small></p>
                                <p class="mb-3">{{ $question }}</p>
                                <p class="text-muted mb-1"><small>Réponse :</small></p>
                                <p class="mb-0">{{ $answer }}</p>
                            </div>
                        </div>
                    @endisset

                    <form method="POST" action="{{ route('assistant.ask') }}" class="card shadow-sm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nom (optionnel)</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Téléphone (optionnel)</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Votre question</label>
                                <textarea name="question" class="form-control" rows="3" required>{{ old('question') }}</textarea>
                            </div>
                            <button class="btn btn-4">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
