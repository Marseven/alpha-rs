@php($user = $user ?? auth()->user())
@extends('layouts.client')

@section('title', 'Changer le mot de passe')
@section('page_title', 'Changer le mot de passe')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('profil') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600 hover:text-primary-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Retour au profil
        </a>

        <form method="POST" action="{{ url('/userpassword/' . $user->id) }}">
            @csrf

            <x-ui.card padding="p-6 lg:p-8">
                <span class="eyebrow">Sécurité</span>
                <h2 class="mt-2 font-display text-xl font-bold text-ink">Changer le mot de passe</h2>
                <p class="mt-1 text-sm text-ink-muted">Choisissez un nouveau mot de passe pour sécuriser votre compte.</p>

                <x-ui.alert type="info" class="mt-5">Le mot de passe doit contenir au moins 6 caractères.</x-ui.alert>

                <div class="mt-6 space-y-5">
                    {{-- Mot de passe actuel --}}
                    <div>
                        <label for="current_password" class="mb-1.5 block text-sm font-semibold text-ink">Mot de passe actuel <span class="text-accent-600">*</span></label>
                        <input type="password" id="current_password" name="current_password" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('current_password')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Nouveau mot de passe --}}
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-ink">Nouveau mot de passe <span class="text-accent-600">*</span></label>
                        <input type="password" id="password" name="password" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('password')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Confirmation --}}
                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-ink">Confirmer le mot de passe <span class="text-accent-600">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-5">
                    <x-ui.button href="{{ route('profil') }}" variant="ghost">Annuler</x-ui.button>
                    <x-ui.button type="submit" variant="accent">Enregistrer</x-ui.button>
                </div>
            </x-ui.card>
        </form>
    </div>
@endsection
