@extends('layouts.backoffice')

@section('title', 'Éléments du simulateur')
@section('page_title', 'Éléments du simulateur')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Simulateur</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Éléments du Simulateur</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des éléments utilisés par le simulateur.</p>
            </div>
            <x-ui.button href="{{ url('admin/list-simulators') }}" variant="outline">Valeurs du simulateur</x-ui.button>
        </div>

        {{-- Flash & erreurs --}}
        @if ($message = session('success'))
            <x-ui.alert type="success">{{ $message }}</x-ui.alert>
        @endif
        @if ($message = session('error'))
            <x-ui.alert type="danger">{{ $message }}</x-ui.alert>
        @endif
        @if ($message = session('warning'))
            <x-ui.alert type="warning">{{ $message }}</x-ui.alert>
        @endif
        @if ($errors->any())
            <x-ui.alert type="danger">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-ui.alert>
        @endif

        {{-- Ajouter --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <details class="group">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4 font-display text-base font-bold text-ink">
                    <span class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                        Ajouter un élément
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="border-t border-line px-6 py-5">
                    <form action="{{ url('admin/simulator-item') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé</label>
                                <input type="text" name="label" value="{{ old('label') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Activé ?</label>
                                <select name="status"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @php App\Http\Controllers\Controller::enable_status(); @endphp
                                </select>
                            </div>
                        </div>
                        <div class="mt-5">
                            <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                        </div>
                    </form>
                </div>
            </details>
        </div>

        {{-- Liste --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des éléments</h3>
                <span class="text-sm text-ink-muted">{{ count($items) }} élément(s)</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Libellé</th>
                            <th class="px-6 py-3 font-semibold">Statut</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            @php
                                $status = App\Http\Controllers\Controller::status($item->status);
                                $pill = [
                                    'success' => 'text-success-700 bg-success-50 border-success-200',
                                    'warning' => 'text-warning-700 bg-warning-50 border-warning-200',
                                    'danger' => 'text-accent-700 bg-accent-50 border-accent-100',
                                    'primary' => 'text-primary-700 bg-primary-50 border-primary-200',
                                    'info' => 'text-primary-700 bg-primary-50 border-primary-200',
                                    'secondary' => 'text-ink-muted bg-canvas border-line',
                                ][$status['type'] ?? 'secondary'] ?? 'text-ink-muted bg-canvas border-line';
                            @endphp
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $item->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $item->label }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $pill }}">{{ $status['message'] ?? '—' }}</span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="#edit-item-{{ $item->id }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Gérer</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-ink-muted">Aucun élément pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modifier / Supprimer --}}
        @if (count($items))
            <div class="rounded-2xl border border-line bg-white shadow-card">
                <div class="border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">Modifier / supprimer</h3>
                </div>
                <div>
                    @foreach ($items as $item)
                        <details id="edit-item-{{ $item->id }}" class="group border-b border-line-subtle last:border-0">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4">
                                <span class="font-semibold text-ink">{{ $item->label }}</span>
                                <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="space-y-5 border-t border-line-subtle bg-canvas px-6 py-5">
                                <form action="{{ url('admin/simulator-item/' . $item->id) }}" method="POST">
                                    @csrf
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé</label>
                                            <input type="text" name="label" value="{{ $item->label }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Activé ?</label>
                                            <select name="status"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                @php App\Http\Controllers\Controller::enable_status(); @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                                    </div>
                                </form>

                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-line bg-white px-4 py-3">
                                    <p class="text-sm text-ink-muted">Êtes-vous sûr de vouloir supprimer cette élément ?</p>
                                    <form action="{{ url('admin/simulator-item/' . $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="delete" value="true">
                                        <button type="submit" class="inline-flex min-h-[40px] items-center justify-center rounded-lg bg-accent-600 px-4 text-sm font-bold text-white transition-colors hover:bg-accent-700">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@endsection
