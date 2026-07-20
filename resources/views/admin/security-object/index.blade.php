@extends('layouts.backoffice')

@section('title', 'Espaces')
@section('page_title', 'Espaces')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Rôles &amp; droits</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Espaces</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des espaces de l'application.</p>
            </div>
            <x-ui.button type="button" variant="primary"
                onclick="document.getElementById('create-object').classList.toggle('hidden')">
                Nouvel espace
            </x-ui.button>
        </div>

        {{-- Créer un espace --}}
        <x-ui.card id="create-object" class="hidden">
            <h3 class="font-display text-base font-bold text-ink">Créer un espace</h3>
            <form action="{{ url('admin/security-object') }}" method="POST" class="mt-4 grid gap-4 sm:grid-cols-2">
                @csrf
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé</label>
                    <input type="text" name="name"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Url</label>
                    <input type="text" name="url"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Icon</label>
                    <input type="text" name="icon"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-ink">Activé ?</label>
                    <select name="enable"
                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
                <div class="flex gap-3 sm:col-span-2">
                    <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                    <button type="button"
                        class="inline-flex min-h-[44px] items-center justify-center rounded-lg bg-canvas px-5 text-[15px] font-bold text-ink-muted transition-colors hover:bg-line-subtle"
                        onclick="document.getElementById('create-object').classList.add('hidden')">Annuler</button>
                </div>
            </form>
        </x-ui.card>

        {{-- Table --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des espaces</h3>
            </div>
            <div class="overflow-x-auto">
                <table data-datatable class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Libellé</th>
                            <th class="px-6 py-3 font-semibold">Url</th>
                            <th class="px-6 py-3 font-semibold">Icon</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($objects as $object)
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $object->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $object->name }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $object->url }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $object->icon }}</td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <form method="POST" action="{{ url('admin/security-object/delete/' . $object->id) }}" class="inline"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet espace ?')">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-accent-100 bg-accent-50 px-3 py-2 text-[13px] font-semibold text-accent-700 transition-colors hover:bg-accent-100">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-ink-muted">Aucun espace pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
