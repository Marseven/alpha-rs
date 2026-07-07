@extends('layouts.backoffice')

@section('title', 'Permissions')
@section('page_title', 'Permissions')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Rôles &amp; droits</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Permissions</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des permissions applicatives.</p>
            </div>
            <x-ui.button type="button" variant="primary"
                onclick="document.getElementById('create-permission').classList.toggle('hidden')">
                Nouvelle permission
            </x-ui.button>
        </div>

        {{-- Créer une permission --}}
        <x-ui.card id="create-permission" class="hidden">
            <h3 class="font-display text-base font-bold text-ink">Créer une permission</h3>
            <form action="{{ url('admin/security-permission') }}" method="POST" class="mt-4 grid gap-4">
                @csrf
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé <span class="text-accent-600">*</span></label>
                    <input type="text" name="name" required
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Description</label>
                    <textarea name="description" id="message-text" rows="3"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15"></textarea>
                </div>
                <div class="flex gap-3">
                    <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                    <button type="button"
                        class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                        onclick="document.getElementById('create-permission').classList.add('hidden')">Annuler</button>
                </div>
            </form>
        </x-ui.card>

        {{-- Table --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des permissions</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Libellé</th>
                            <th class="px-6 py-3 font-semibold">Description</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $permission->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $permission->name }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $permission->description }}</td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ url('admin/security-permission/delete/' . $permission->id) }}"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette permission ?')"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-accent-100 bg-accent-50 px-3 py-2 text-[13px] font-semibold text-accent-700 transition-colors hover:bg-accent-100">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-ink-muted">Aucune permission pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
