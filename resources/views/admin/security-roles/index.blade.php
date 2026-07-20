@extends('layouts.backoffice')

@section('title', 'Rôles')
@section('page_title', 'Rôles')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Rôles &amp; droits</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Rôles</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des rôles et de leurs permissions.</p>
            </div>
            <x-ui.button type="button" variant="primary"
                onclick="document.getElementById('create-role').classList.toggle('hidden')">
                Nouveau rôle
            </x-ui.button>
        </div>

        {{-- Créer un rôle --}}
        <x-ui.card id="create-role" class="hidden">
            <h3 class="font-display text-base font-bold text-ink">Créer un rôle</h3>
            <form action="{{ url('admin/security-role') }}" method="POST" class="mt-4 grid gap-4 sm:grid-cols-2">
                @csrf
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé</label>
                    <input type="text" name="name"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Espace</label>
                    <select name="security_object_id"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        @foreach ($objects as $object)
                            <option value="{{ $object->id }}">{{ $object->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 sm:col-span-2">
                    <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                    <button type="button"
                        class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                        onclick="document.getElementById('create-role').classList.add('hidden')">Annuler</button>
                </div>
            </form>
        </x-ui.card>

        {{-- Table --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des rôles</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Libellé</th>
                            <th class="px-6 py-3 font-semibold">Espace</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            @php $role->load(['objects']); @endphp
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $role->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $role->name }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $role->objects->first() != null ? $role->objects->first()->name : '' }}</td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-line-strong bg-white px-3 py-2 text-[13px] font-semibold text-ink transition-colors hover:bg-canvas"
                                            onclick="document.getElementById('view-role-{{ $role->id }}').classList.toggle('hidden')">Voir</button>
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-primary-600 bg-white px-3 py-2 text-[13px] font-semibold text-primary-600 transition-colors hover:bg-primary-50"
                                            onclick="document.getElementById('edit-role-{{ $role->id }}').classList.toggle('hidden')">Modifier</button>
                                        <form method="POST" action="{{ url('admin/security-role/delete/' . $role->id) }}" class="inline"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-accent-100 bg-accent-50 px-3 py-2 text-[13px] font-semibold text-accent-700 transition-colors hover:bg-accent-100">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-ink-muted">Aucun rôle pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Voir les permissions du rôle (lecture seule) --}}
        @foreach ($roles as $role)
            <x-ui.card id="view-role-{{ $role->id }}" class="hidden" padding="p-0">
                <div class="flex items-center justify-between border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">{{ $role->name }} — permissions</h3>
                    <button type="button"
                        class="text-sm font-semibold text-ink-muted hover:text-ink"
                        onclick="document.getElementById('view-role-{{ $role->id }}').classList.add('hidden')">Fermer</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                                <th class="px-6 py-3 font-semibold">Permissions du rôle</th>
                                <th class="px-6 py-3 text-center font-semibold">Voir</th>
                                <th class="px-6 py-3 text-center font-semibold">Créer</th>
                                <th class="px-6 py-3 text-center font-semibold">Modifier</th>
                                <th class="px-6 py-3 text-center font-semibold">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rolepermissions as $permission)
                                @if ($permission->security_role_id == $role->id)
                                    <tr class="border-b border-line-subtle last:border-0">
                                        <td class="px-6 py-3.5 font-medium text-ink">{{ $permission->name }}</td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" {{ $permission->look == 'on' ? 'checked' : '' }} disabled
                                                class="h-4 w-4 rounded border-line-strong text-primary-600">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" {{ $permission->creat == 'on' ? 'checked' : '' }} disabled
                                                class="h-4 w-4 rounded border-line-strong text-primary-600">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" {{ $permission->updat == 'on' ? 'checked' : '' }} disabled
                                                class="h-4 w-4 rounded border-line-strong text-primary-600">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" {{ $permission->del == 'on' ? 'checked' : '' }} disabled
                                                class="h-4 w-4 rounded border-line-strong text-primary-600">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-ui.card>
        @endforeach

        {{-- Modifier les permissions du rôle --}}
        @foreach ($roles as $role)
            <x-ui.card id="edit-role-{{ $role->id }}" class="hidden" padding="p-0">
                <form action="{{ url('admin/security-permission/edit/' . $role->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-between border-b border-line px-6 py-4">
                        <h3 class="font-display text-base font-bold text-ink">{{ $role->name }} — modifier les permissions</h3>
                        <button type="button"
                            class="text-sm font-semibold text-ink-muted hover:text-ink"
                            onclick="document.getElementById('edit-role-{{ $role->id }}').classList.add('hidden')">Fermer</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                                    <th class="px-6 py-3 font-semibold">Permissions du rôle</th>
                                    <th class="px-6 py-3 text-center font-semibold">Voir</th>
                                    <th class="px-6 py-3 text-center font-semibold">Créer</th>
                                    <th class="px-6 py-3 text-center font-semibold">Modifier</th>
                                    <th class="px-6 py-3 text-center font-semibold">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                        <td class="px-6 py-3.5 font-medium text-ink">
                                            {{ $permission->name }}
                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <input type="hidden" name="{{ $permission->name }}-permission" value="{{ $permission->id }}">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" name="{{ $permission->name }}-view"
                                                class="h-4 w-4 rounded border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/30">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" name="{{ $permission->name }}-create"
                                                class="h-4 w-4 rounded border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/30">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" name="{{ $permission->name }}-edit"
                                                class="h-4 w-4 rounded border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/30">
                                        </td>
                                        <td class="px-6 py-3.5 text-center">
                                            <input type="checkbox" name="{{ $permission->name }}-delete"
                                                class="h-4 w-4 rounded border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/30">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-line px-6 py-4">
                        <button type="button"
                            class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                            onclick="document.getElementById('edit-role-{{ $role->id }}').classList.add('hidden')">Annuler</button>
                        <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                    </div>
                </form>
            </x-ui.card>
        @endforeach

    </div>
@endsection
