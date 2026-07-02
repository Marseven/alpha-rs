<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('relief.name') }} — {{ $title ?? '' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/brand.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg" style="background:var(--brand, #1b73d3)">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">{{ config('relief.name') }}</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50 small">{{ auth()->user()->name ?? '' }}
                    @if(auth()->user()?->isDoctor()) · Médecin @elseif(auth()->user()?->isPharmacy()) · CNAMGS @endif
                </span>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="btn btn-sm btn-light">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <h1 class="h4 mb-4">{{ $title ?? '' }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">
                @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul></div>
        @endif

        @yield('content')
    </main>
</body>
</html>
