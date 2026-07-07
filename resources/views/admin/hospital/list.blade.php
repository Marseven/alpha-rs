@extends('layouts.backoffice')

@section('title', 'Hôpitaux')
@section('page_title', 'Hôpitaux')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Catalogue</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Hôpitaux</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des hôpitaux partenaires et des pathologies traitées.</p>
            </div>
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
                        Ajouter un hôpital
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="border-t border-line px-6 py-5">
                    <form action="{{ url('admin/hospital') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé</label>
                                <input type="text" name="label" value="{{ old('label') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Description</label>
                                <textarea name="description"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">Description...</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Ville</label>
                                <select name="town_id"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    <option value="">Choisir...</option>
                                    @foreach ($towns as $town)
                                        <option value="{{ $town->id }}">{{ $town->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Image 1</label>
                                <input type="file" name="picture_1"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2 text-[15px] text-ink file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 focus:border-primary-600">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Image 2</label>
                                <input type="file" name="picture_2"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2 text-[15px] text-ink file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 focus:border-primary-600">
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
                <h3 class="font-display text-base font-bold text-ink">Liste des hôpitaux</h3>
                <span class="text-sm text-ink-muted">{{ count($hospitals) }} hôpital(aux)</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Libellé</th>
                            <th class="px-6 py-3 font-semibold">Pays</th>
                            <th class="px-6 py-3 font-semibold">Ville</th>
                            <th class="px-6 py-3 font-semibold">Statut</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hospitals as $hospital)
                            @php
                                $status = App\Http\Controllers\Controller::status($hospital->status);
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
                                <td class="px-6 py-3.5">
                                    <img src="{{ asset($hospital->picture_1) }}" alt="" class="h-9 w-9 rounded-full border border-line">
                                </td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $hospital->label }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $hospital->country?->label }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $hospital->town?->label }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $pill }}">{{ $status['message'] ?? '—' }}</span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="#edit-hospital-{{ $hospital->id }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Gérer</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-8 text-center text-ink-muted">Aucun hôpital pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modifier / Supprimer / Maladies --}}
        @if (count($hospitals))
            <div class="rounded-2xl border border-line bg-white shadow-card">
                <div class="border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">Modifier / supprimer</h3>
                </div>
                <div>
                    @foreach ($hospitals as $hospital)
                        <details id="edit-hospital-{{ $hospital->id }}" class="group border-b border-line-subtle last:border-0">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4">
                                <span class="flex items-center gap-3">
                                    <img src="{{ asset($hospital->picture_1) }}" alt="" class="h-8 w-8 rounded-full border border-line">
                                    <span class="font-semibold text-ink">{{ $hospital->label }}</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="space-y-5 border-t border-line-subtle bg-canvas px-6 py-5">
                                {{-- Édition de l'hôpital --}}
                                <form action="{{ url('admin/hospital/' . $hospital->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div class="sm:col-span-2">
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Libellé</label>
                                            <input type="text" name="label" value="{{ $hospital->label }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Description</label>
                                            <textarea name="description"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ $hospital->description }}</textarea>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Ville</label>
                                            <select name="town_id"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <option value="">Choisir...</option>
                                                @foreach ($towns as $town)
                                                    <option value="{{ $town->id }}">{{ $town->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Image 1</label>
                                            <input type="file" name="picture"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2 text-[15px] text-ink file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 focus:border-primary-600">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Image 2</label>
                                            <input type="file" name="picture"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2 text-[15px] text-ink file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 focus:border-primary-600">
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

                                {{-- Maladies traitées (état actuel) --}}
                                <details class="group/sick rounded-xl border border-line bg-white">
                                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-4 py-3 text-sm font-semibold text-ink">
                                        Maladies traitées
                                        <svg class="h-4 w-4 shrink-0 text-primary-600 transition-transform duration-200 group-open/sick:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </summary>
                                    <div class="border-t border-line-subtle px-4 py-4">
                                        <form action="{{ url('admin/hospital-sick/' . $hospital->id) }}" method="POST">
                                            @csrf
                                            <div class="space-y-2">
                                                @foreach ($sicks as $sick)
                                                    @foreach ($hospital->sicks as $hs)
                                                        @if ($hs->id == $sick->id)
                                                            <label class="flex items-center gap-3 rounded-lg border border-line bg-canvas px-3 py-2 text-sm text-ink">
                                                                <input type="checkbox" checked name="{{ $sick->label }}" class="h-4 w-4" disabled>
                                                                <span>{{ $sick->label }}</span>
                                                                <input type="hidden" name="hospital" value="{{ $hospital->id }}">
                                                                <input type="hidden" name="{{ $sick->label }}-sick" value="{{ $sick->id }}">
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                            <div class="mt-4">
                                                <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                                            </div>
                                        </form>
                                    </div>
                                </details>

                                {{-- Modifier les maladies traitées --}}
                                <details class="group/sicke rounded-xl border border-line bg-white">
                                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-4 py-3 text-sm font-semibold text-ink">
                                        Modifier les maladies traitées
                                        <svg class="h-4 w-4 shrink-0 text-primary-600 transition-transform duration-200 group-open/sicke:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </summary>
                                    <div class="border-t border-line-subtle px-4 py-4">
                                        <form action="{{ url('admin/hospital-sick/' . $hospital->id) }}" method="POST">
                                            @csrf
                                            <div class="space-y-2">
                                                @foreach ($sicks as $sick)
                                                    <label class="flex items-center gap-3 rounded-lg border border-line bg-canvas px-3 py-2 text-sm text-ink">
                                                        <input type="checkbox" name="sick-{{ $sick->id }}" class="h-4 w-4">
                                                        <span>{{ $sick->label }}</span>
                                                        <input type="hidden" name="hospital" value="{{ $hospital->id }}">
                                                        <input type="hidden" name="{{ $sick->id }}-sick" value="{{ $sick->id }}">
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="mt-4">
                                                <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                                            </div>
                                        </form>
                                    </div>
                                </details>

                                {{-- Suppression --}}
                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-line bg-white px-4 py-3">
                                    <p class="text-sm text-ink-muted">Êtes-vous sûr de vouloir supprimer cet hôpital ?</p>
                                    <form action="{{ url('admin/hospital/' . $hospital->id) }}" method="POST">
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
