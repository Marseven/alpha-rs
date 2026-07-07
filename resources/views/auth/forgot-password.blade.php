@extends('layouts.login')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="mb-6">
        <span class="eyebrow text-primary-600">Récupération</span>
        <h1 class="mt-2 font-display text-2xl font-extrabold text-ink">Mot de passe oublié</h1>
        <p class="mt-1.5 text-sm text-ink-muted">Indiquez votre email : nous vous enverrons un lien de réinitialisation.</p>
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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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

        <x-ui.button type="submit" variant="accent" class="mt-2 w-full">Envoyer le lien</x-ui.button>
    </form>

    <p class="mt-6 text-center text-sm text-ink-muted">
        Vous vous souvenez de votre mot de passe ?
        <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-700">Connexion</a>
    </p>
@endsection
