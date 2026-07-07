@extends('layouts.backoffice')

@section('title', 'Ajouter un utilisateur')
@section('page_title', 'Ajouter un utilisateur')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div>
            <span class="eyebrow">Administration</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Ajouter un utilisateur</h2>
            <p class="mt-1 text-sm text-ink-muted">Informations personnelles du nouvel utilisateur.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-1">
                <h3 class="font-display text-base font-bold text-ink">Informations</h3>
                <p class="mt-1 text-sm text-ink-muted">Renseignez le nom, l'email et le rôle attribué à l'utilisateur.</p>
            </div>

            <div class="lg:col-span-2">
                <x-ui.card>
                    <form method="POST" action="{{ url('admin/register') }}" class="grid gap-4 sm:grid-cols-2">
                        @csrf
                        <div class="sm:col-span-2">
                            <label for="name" class="mb-1.5 block text-sm font-semibold text-ink">Nom complet <span class="text-accent-600">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('name')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-semibold text-ink">Email <span class="text-accent-600">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('email')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone <span class="text-accent-600">*</span></label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('phone')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="security_role_id" class="mb-1.5 block text-sm font-semibold text-ink">Rôle <span class="text-accent-600">*</span></label>
                            <select id="security_role_id" name="security_role_id"
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @selected(old('security_role_id') == $role->id)>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('security_role_id')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="sm:col-span-2">
                            <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                        </div>
                    </form>
                </x-ui.card>
            </div>
        </div>
    </div>
@endsection
