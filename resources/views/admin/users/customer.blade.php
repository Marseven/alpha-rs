@extends('layouts.backoffice')

@section('title', 'Clients')
@section('page_title', 'Clients')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div>
            <span class="eyebrow">Administration</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Gestion des clients</h2>
            <p class="mt-1 text-sm text-ink-muted">Liste des comptes clients, de leurs rôles et de leur statut.</p>
        </div>

        {{-- Table --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des clients</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
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
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $user->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $user->name }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->email }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->security_role?->name ?? '—' }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->security_object?->enable ?? '—' }}</td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-line-strong bg-white px-3 py-2 text-[13px] font-semibold text-ink transition-colors hover:bg-canvas"
                                            onclick="document.getElementById('status-form').classList.remove('hidden')">Modifier</button>
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-accent-100 bg-accent-50 px-3 py-2 text-[13px] font-semibold text-accent-700 transition-colors hover:bg-accent-100"
                                            onclick="document.getElementById('delete-confirm').classList.remove('hidden')">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-8 text-center text-ink-muted">Aucun client pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mettre à jour le statut --}}
        <x-ui.card id="status-form" class="hidden">
            <h3 class="font-display text-base font-bold text-ink">Mettre à jour le statut</h3>
            <form action="{{ route('admin-card') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label for="selectOne" class="mb-1.5 block text-sm font-semibold text-ink">Statut</label>
                    <select id="selectOne"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        <option>En Cours</option>
                        <option>Terminé</option>
                        <option>En Attente</option>
                        <option>Annulé</option>
                        <option>Refusé</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                    <button type="button"
                        class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                        onclick="document.getElementById('status-form').classList.add('hidden')">Fermer</button>
                </div>
            </form>
        </x-ui.card>

        {{-- Confirmation de suppression --}}
        <x-ui.card id="delete-confirm" class="hidden">
            <h3 class="font-display text-base font-bold text-ink">Suppression</h3>
            <p class="mt-2 text-sm text-ink-muted">Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
            <div class="mt-4 flex gap-3">
                <button type="button"
                    class="inline-flex min-h-[44px] items-center justify-center rounded-lg border border-accent-100 bg-accent-50 px-5 text-[15px] font-bold text-accent-700 transition-colors hover:bg-accent-100">Supprimer</button>
                <button type="button"
                    class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                    onclick="document.getElementById('delete-confirm').classList.add('hidden')">Fermer</button>
            </div>
        </x-ui.card>

    </div>
@endsection
