@extends('layouts.backoffice')

@section('title', 'Simulateur')
@section('page_title', 'Simulateur')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Simulateur</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Valeurs du Simulateur</h2>
                <p class="mt-1 text-sm text-ink-muted">Gestion des valeurs par pays, service et pathologie.</p>
            </div>
            <x-ui.button href="{{ url('admin/list-simulators-items') }}" variant="outline">Éléments du simulateur</x-ui.button>
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
                        Ajouter une valeur
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="border-t border-line px-6 py-5">
                    <form action="{{ url('admin/simulator') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Pays</label>
                                <select name="country_id"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Service</label>
                                <select name="service_id"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Pathologie</label>
                                <select name="sick_id"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @foreach ($sicks as $sick)
                                        <option value="{{ $sick->id }}">{{ $sick->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Élément</label>
                                <select name="item_id"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Prix unitaire (XAF)</label>
                                <input type="number" name="unit_price" value="{{ old('unit_price') }}" min="0" step="1"
                                    placeholder="ex. 60000"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('unit_price')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Quantité</label>
                                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="0.01" step="0.01"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('quantity')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Catégorie</label>
                                <input type="text" name="category" value="{{ old('category') }}" placeholder="ex. Médical, Séjour"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Valeur (libellé, optionnel)</label>
                                <input type="text" name="value" value="{{ old('value') }}" placeholder="Repli si pas de prix unitaire"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div class="flex items-end gap-5 pb-2.5">
                                <label class="inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                    <input type="checkbox" name="is_optional" value="1" @checked(old('is_optional')) class="h-4 w-4 rounded border-line-strong text-primary-600">
                                    Facultatif
                                </label>
                                <label class="inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                    <input type="checkbox" name="is_estimate" value="1" @checked(old('is_estimate', true)) class="h-4 w-4 rounded border-line-strong text-primary-600">
                                    Estimé
                                </label>
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
                <span class="text-sm text-ink-muted">{{ count($simulators) }} valeur(s)</span>
            </div>
            <div class="overflow-x-auto">
                <table data-datatable class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Libellé</th>
                            <th class="px-6 py-3 font-semibold">Prix unit.</th>
                            <th class="px-6 py-3 font-semibold">Qté</th>
                            <th class="px-6 py-3 font-semibold">Catégorie</th>
                            <th class="px-6 py-3 font-semibold">Pathologie</th>
                            <th class="px-6 py-3 font-semibold">Service</th>
                            <th class="px-6 py-3 font-semibold">Pays</th>
                            <th class="px-6 py-3 font-semibold">Statut</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($simulators as $simulator)
                            @php
                                $status = App\Http\Controllers\Controller::status($simulator->status);
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
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $simulator->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $simulator->item?->label }}</td>
                                <td class="px-6 py-3.5 font-mono text-ink">{{ $simulator->unit_price !== null ? number_format($simulator->unit_price, 0, ',', ' ') : ($simulator->value ?: '—') }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ rtrim(rtrim(number_format($simulator->quantity ?? 1, 2, ',', ' '), '0'), ',') }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $simulator->category ?: '—' }}@if($simulator->is_optional) <span class="text-[11px] text-ink-faint">(fac.)</span>@endif</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $simulator->sick?->label }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $simulator->service?->label }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $simulator->country?->label }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $pill }}">{{ $status['message'] ?? '—' }}</span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="#edit-simulator-{{ $simulator->id }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Gérer</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10" class="px-6 py-8 text-center text-ink-muted">Aucune valeur pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modifier / Supprimer --}}
        @if (count($simulators))
            <div class="rounded-2xl border border-line bg-white shadow-card">
                <div class="border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">Modifier / supprimer</h3>
                </div>
                <div>
                    @foreach ($simulators as $simulator)
                        <details id="edit-simulator-{{ $simulator->id }}" class="group border-b border-line-subtle last:border-0">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4">
                                <span class="flex flex-wrap items-center gap-2">
                                    <span class="font-semibold text-ink">{{ $simulator->item?->label ?? ('#' . $simulator->id) }}</span>
                                    <span class="text-sm text-ink-muted">— {{ $simulator->service?->label }} · {{ $simulator->country?->label }}</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="space-y-5 border-t border-line-subtle bg-canvas px-6 py-5">
                                <form action="{{ url('admin/simulator/' . $simulator->id) }}" method="POST">
                                    @csrf
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Pays</label>
                                            <select name="country_id"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <option value="{{ $simulator->country_id }}">{{ $simulator->country?->label }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Service</label>
                                            <select name="service_id"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <option value="{{ $simulator->service_id }}">{{ $simulator->service?->label }}</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Pathologie</label>
                                            <select name="sick_id"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <option value="{{ $simulator->sick_id }}">{{ $simulator->sick?->label }}</option>
                                                @foreach ($sicks as $sick)
                                                    <option value="{{ $sick->id }}">{{ $sick->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Élément</label>
                                            <select name="item_id"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <option value="{{ $simulator->simulator_item_id }}">{{ $simulator->item?->label }}</option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Prix unitaire (XAF)</label>
                                            <input type="number" name="unit_price" value="{{ $simulator->unit_price }}" min="0" step="1"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Quantité</label>
                                            <input type="number" name="quantity" value="{{ $simulator->quantity ?? 1 }}" min="0.01" step="0.01"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Catégorie</label>
                                            <input type="text" name="category" value="{{ $simulator->category }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Valeur (libellé, optionnel)</label>
                                            <input type="text" name="value" value="{{ $simulator->value }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div class="flex items-center gap-5 sm:col-span-2">
                                            <label class="inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                                <input type="checkbox" name="is_optional" value="1" @checked($simulator->is_optional) class="h-4 w-4 rounded border-line-strong text-primary-600">
                                                Facultatif
                                            </label>
                                            <label class="inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                                <input type="checkbox" name="is_estimate" value="1" @checked($simulator->is_estimate) class="h-4 w-4 rounded border-line-strong text-primary-600">
                                                Estimé
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                                    </div>
                                </form>

                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-line bg-white px-4 py-3">
                                    <p class="text-sm text-ink-muted">Êtes-vous sûr de vouloir supprimer ce simulateur ?</p>
                                    <form action="{{ url('admin/simulator/' . $simulator->id) }}" method="POST">
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
