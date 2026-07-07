@extends('layouts.medical')

@section('title', 'Mon profil')
@section('page_title', 'Mon profil')

@section('content')
    <div class="mx-auto max-w-2xl space-y-6">

        <div>
            <span class="eyebrow">Mon compte</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Profil</h2>
            <p class="mt-1 text-sm text-ink-muted">Vos informations et votre mot de passe.</p>
        </div>

        <x-ui.card padding="p-6">
            <div class="flex items-center gap-4 border-b border-line pb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary-600 font-display text-lg font-bold text-white">
                    {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="font-display text-lg font-bold text-ink">{{ $user->name }}</div>
                    <div class="text-sm text-ink-muted">{{ $user->email }}</div>
                    <x-ui.badge :label="$user->workflow_role === 'cnamgs' ? 'CNAMGS' : 'Médecin'" class="mt-2 text-primary-700 bg-primary-50 border-primary-200" />
                </div>
            </div>

            <form method="POST" action="{{ route('medical.profile.update') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="name" class="mb-1.5 block text-sm font-semibold text-ink">Nom complet <span class="text-accent-600">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    @error('name')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled
                               class="w-full cursor-not-allowed rounded-lg border-[1.5px] border-line bg-canvas px-3.5 py-2.5 text-[15px] text-ink-muted">
                    </div>
                    <div>
                        <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @error('phone')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="border-t border-line pt-4">
                    <p class="mb-3 text-sm font-semibold text-ink">Changer le mot de passe <span class="font-normal text-ink-faint">(optionnel)</span></p>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-semibold text-ink">Nouveau mot de passe</label>
                            <input type="password" id="password" name="password" autocomplete="new-password"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('password')<p class="mt-1 text-sm text-accent-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-ink">Confirmer</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <x-ui.button type="submit" variant="accent">Enregistrer</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
