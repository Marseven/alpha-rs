@extends('layouts.backoffice')

@section('title', 'Utilisateurs')
@section('page_title', 'Utilisateurs')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Administration</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Utilisateurs</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des comptes et des rôles.</p>
            </div>
            <x-ui.button type="button" variant="primary"
                onclick="document.getElementById('create-user').classList.toggle('hidden')">
                Nouvel utilisateur
            </x-ui.button>
        </div>

        {{-- Créer un utilisateur --}}
        <x-ui.card id="create-user" class="hidden">
            <h3 class="font-display text-base font-bold text-ink">Créer un utilisateur</h3>
            <form action="{{ url('admin/register') }}" method="POST" class="mt-4 grid gap-4 sm:grid-cols-2">
                @csrf
                <div>
                    <label for="name" class="mb-1.5 block text-sm font-semibold text-ink">Nom complet <span class="text-accent-600">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    @error('name')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-ink">Email <span class="text-accent-600">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    @error('email')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone <span class="text-accent-600">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    @error('phone')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="security_role_id" class="mb-1.5 block text-sm font-semibold text-ink">Rôle <span class="text-accent-600">*</span></label>
                    <select id="security_role_id" name="security_role_id"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('security_role_id') == $role->id)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('security_role_id')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex gap-3 sm:col-span-2">
                    <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                    <button type="button"
                        class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                        onclick="document.getElementById('create-user').classList.add('hidden')">Annuler</button>
                </div>
            </form>
        </x-ui.card>

        {{-- Table --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des utilisateurs</h3>
            </div>
            <div class="overflow-x-auto">
                <table data-datatable class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Nom complet</th>
                            <th class="px-6 py-3 font-semibold">Email</th>
                            <th class="px-6 py-3 font-semibold">Rôle</th>
                            <th class="px-6 py-3 font-semibold">Statut</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @php
                                $status = App\Http\Controllers\Controller::status($user->status);
                                $statusTone = [
                                    'success' => 'text-success-700 bg-success-50 border-success-200',
                                    'danger' => 'text-accent-700 bg-accent-50 border-accent-100',
                                    'warning' => 'text-warning-700 bg-warning-50 border-warning-200',
                                ][$status['type']] ?? 'text-ink-muted bg-canvas border-line';
                            @endphp
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $user->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $user->name }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->email }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->role ? $user->role?->name : 'Client' }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $statusTone }}">{{ $status['message'] }}</span>
                                </td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-line-strong bg-white px-3 py-2 text-[13px] font-semibold text-ink transition-colors hover:bg-canvas"
                                            onclick="document.getElementById('edit-user-{{ $user->id }}').classList.toggle('hidden')">Modifier</button>
                                        <form action="{{ url('admin/admin-user/' . $user->id) }}" method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" class="inline">
                                            @csrf
                                            <input type="hidden" name="delete" value="true">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-accent-100 bg-accent-50 px-3 py-2 text-[13px] font-semibold text-accent-700 transition-colors hover:bg-accent-100">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-8 text-center text-ink-muted">Aucun utilisateur pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modifier un utilisateur --}}
        @foreach ($users as $user)
            <x-ui.card id="edit-user-{{ $user->id }}" class="hidden">
                <h3 class="font-display text-base font-bold text-ink">Modifier un utilisateur</h3>
                <form action="{{ url('admin/admin-user/' . $user->id) }}" method="POST" class="mt-4 grid gap-4 sm:grid-cols-2">
                    @csrf
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink">Nom complet</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                            class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}"
                            class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink">Rôle</label>
                        <select name="security_role_id"
                            class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @selected($user->security_role_id == $role->id)>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-3 sm:col-span-2">
                        <x-ui.button type="submit" variant="primary">Modifier</x-ui.button>
                        <button type="button"
                            class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                            onclick="document.getElementById('edit-user-{{ $user->id }}').classList.add('hidden')">Fermer</button>
                    </div>
                </form>
            </x-ui.card>
        @endforeach

    </div>
@endsection
