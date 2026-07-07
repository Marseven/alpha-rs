@php($user = $user ?? auth()->user())
@extends('layouts.client')

@section('title', 'Modifier mes informations')
@section('page_title', 'Modifier mes informations')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('profil') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600 hover:text-primary-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Retour au profil
        </a>

        <form method="POST" action="{{ url('/user/' . $user->id) }}" enctype="multipart/form-data">
            @csrf

            <x-ui.card padding="p-6 lg:p-8">
                <span class="eyebrow">Mon compte</span>
                <h2 class="mt-2 font-display text-xl font-bold text-ink">Informations personnelles</h2>
                <p class="mt-1 text-sm text-ink-muted">Mettez à jour votre photo et vos coordonnées.</p>

                <div class="mt-6 space-y-5">
                    {{-- Photo de profil --}}
                    <div>
                        <label for="picture" class="mb-1.5 block text-sm font-semibold text-ink">Photo de profil</label>
                        <div class="flex items-center gap-4">
                            @if ($user->picture)
                                <img src="{{ asset($user->picture) }}" alt="{{ $user->name }}"
                                     class="h-16 w-16 flex-none rounded-full object-cover ring-2 ring-line">
                            @else
                                <div class="flex h-16 w-16 flex-none items-center justify-center rounded-full bg-primary-600 font-display text-lg font-extrabold text-white">
                                    {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            <input type="file" id="picture" name="picture" accept=".png,.jpg,.jpeg"
                                   class="block w-full text-sm text-ink-muted file:mr-3 file:rounded-lg file:border-0 file:bg-primary-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-primary-700 hover:file:bg-primary-100">
                        </div>
                        <p class="mt-1 text-xs text-ink-faint">Formats acceptés : png, jpg, jpeg.</p>
                        @error('picture')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Nom complet --}}
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-ink">Nom complet <span class="text-accent-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('name')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-ink">Email <span class="text-accent-600">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('email')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Téléphone --}}
                    <div>
                        <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('phone')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
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
