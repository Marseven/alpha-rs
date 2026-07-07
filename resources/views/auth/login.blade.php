@extends('layouts.login')

@section('title', 'Connexion — Espace client')

@section('content')
    <div class="mb-6">
        <span class="eyebrow text-primary-600">Espace client</span>
        <h1 class="mt-2 font-display text-2xl font-extrabold text-ink">Se connecter</h1>
        <p class="mt-1.5 text-sm text-ink-muted">Accédez au suivi de vos dossiers et de vos devis.</p>
    </div>

    @if (session('status'))
        <x-ui.alert type="success" class="mb-5">{{ session('status') }}</x-ui.alert>
    @endif
    @if (session('success'))
        <x-ui.alert type="success" class="mb-5">{{ session('success') }}</x-ui.alert>
    @endif
    @if (session('error'))
        <x-ui.alert type="danger" class="mb-5">{{ session('error') }}</x-ui.alert>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-ink">
                Email <span class="text-accent-600">*</span>
            </label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                   autocomplete="email" placeholder="hello@example.com"
                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
            @error('email')
                <p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-ink">
                Mot de passe <span class="text-accent-600">*</span>
            </label>
            <input type="password" id="password" name="password" required
                   autocomplete="current-password" placeholder="Votre mot de passe"
                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
            @error('password')
                <p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between gap-3 pt-1">
            <label for="remember" class="inline-flex items-center gap-2 text-sm text-ink-muted">
                <input type="checkbox" id="remember" name="remember"
                       class="h-4 w-4 rounded border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/25">
                Se souvenir de moi
            </label>
            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">
                Mot de passe oublié ?
            </a>
        </div>

        <x-ui.button type="submit" variant="accent" class="mt-2 w-full">Se connecter</x-ui.button>
    </form>

    <p class="mt-6 text-center text-sm text-ink-muted">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-700">Créer un compte</a>
    </p>
@endsection
