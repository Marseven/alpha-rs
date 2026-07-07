@extends('layouts.client')

@section('title', 'Mon profil')
@section('page_title', 'Mon profil')

@section('content')
    @php
        $roleLabels = ['doctor' => 'Médecin', 'cnamgs' => 'Agent CNAMGS', 'admin' => 'Administrateur'];
        $roleLabel = $roleLabels[$user->workflow_role] ?? 'Client';
        $parts = preg_split('/\s+/', trim($user->name ?? ''));
        $initials = strtoupper(mb_substr($parts[0] ?? 'U', 0, 1) . (count($parts) > 1 ? mb_substr(end($parts), 0, 1) : ''));
    @endphp

    <div class="mx-auto max-w-container">
        <div class="grid gap-6 lg:grid-cols-3">
            {{-- Carte résumé --}}
            <x-ui.card class="lg:col-span-1" padding="p-6">
                <div class="flex flex-col items-center text-center">
                    @if ($user->picture)
                        <img src="{{ asset($user->picture) }}" alt="{{ $user->name }}"
                             class="h-24 w-24 rounded-full object-cover ring-2 ring-line">
                    @else
                        <div class="flex h-24 w-24 items-center justify-center rounded-full bg-primary-600 font-display text-2xl font-extrabold text-white">
                            {{ $initials }}
                        </div>
                    @endif
                    <h2 class="mt-4 font-display text-xl font-bold text-ink">{{ $user->name }}</h2>
                    <p class="mt-1 break-all text-sm text-ink-muted">{{ $user->email }}</p>
                    <span class="mt-3 inline-flex items-center rounded-full border border-primary-200 bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-700">
                        {{ $roleLabel }}
                    </span>
                </div>

                <div class="mt-6 space-y-2">
                    <x-ui.button href="{{ url('/user/' . $user->id) }}" variant="primary" class="w-full">Modifier mes informations</x-ui.button>
                    <x-ui.button href="{{ url('/userpassword/' . $user->id) }}" variant="outline" class="w-full">Changer le mot de passe</x-ui.button>
                </div>
            </x-ui.card>

            {{-- Détails du compte --}}
            <x-ui.card class="lg:col-span-2" padding="p-6 lg:p-8">
                <span class="eyebrow">Mon compte</span>
                <h3 class="mt-2 font-display text-lg font-bold text-ink">Informations personnelles</h3>
                <p class="mt-1 text-sm text-ink-muted">Vos coordonnées telles qu'enregistrées sur votre compte Relief Services.</p>

                <dl class="mt-5 divide-y divide-line">
                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="text-sm font-semibold text-ink">Nom complet</dt>
                        <dd class="text-right text-sm text-ink-muted">{{ $user->name ?: '—' }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="text-sm font-semibold text-ink">Email</dt>
                        <dd class="break-all text-right text-sm text-ink-muted">{{ $user->email ?: '—' }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="text-sm font-semibold text-ink">Téléphone</dt>
                        <dd class="text-right text-sm text-ink-muted">{{ $user->phone ?: '—' }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="text-sm font-semibold text-ink">Type de compte</dt>
                        <dd class="text-right text-sm text-ink-muted">{{ $roleLabel }}</dd>
                    </div>
                </dl>
            </x-ui.card>
        </div>
    </div>
@endsection
