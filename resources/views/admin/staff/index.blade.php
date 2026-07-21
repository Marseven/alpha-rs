@extends('layouts.backoffice')

@section('title', 'Personnel médical')
@section('page_title', 'Médecins & CNAMGS')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Personnel médical</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Médecins &amp; CNAMGS</h2>
                <p class="mt-1 text-sm text-ink-muted">Créez les comptes qui accèdent à l'espace médecin ou CNAMGS.</p>
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

        {{-- Ajouter un membre --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <details class="group">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4 font-display text-base font-bold text-ink">
                    <span class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                        Ajouter un membre
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="border-t border-line px-6 py-5">
                    <form method="POST" action="{{ url('admin/staff') }}">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
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
                                <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('phone')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="workflow_role" class="mb-1.5 block text-sm font-semibold text-ink">Rôle <span class="text-accent-600">*</span></label>
                                <select id="workflow_role" name="workflow_role" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    <option value="doctor" @selected(old('workflow_role') === 'doctor')>Médecin</option>
                                    <option value="cnamgs" @selected(old('workflow_role') === 'cnamgs')>CNAMGS</option>
                                </select>
                                @error('workflow_role')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="specialty" class="mb-1.5 block text-sm font-semibold text-ink">Spécialité</label>
                                <input type="text" id="specialty" name="specialty" value="{{ old('specialty') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('specialty')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="license_number" class="mb-1.5 block text-sm font-semibold text-ink">N° professionnel</label>
                                <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('license_number')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="institution" class="mb-1.5 block text-sm font-semibold text-ink">Institution / établissement</label>
                                <input type="text" id="institution" name="institution" value="{{ old('institution') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('institution')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="password" class="mb-1.5 block text-sm font-semibold text-ink">Mot de passe <span class="text-accent-600">*</span></label>
                                <input type="password" id="password" name="password" required minlength="8"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                <p class="mt-1 text-xs text-ink-muted">Mot de passe initial (8 caractères minimum).</p>
                                @error('password')<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
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
                <h3 class="font-display text-base font-bold text-ink">Liste du personnel</h3>
                <span class="text-sm text-ink-muted">{{ count($staff) }} membre(s)</span>
            </div>
            <div class="overflow-x-auto">
                <table data-datatable class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">Nom</th>
                            <th class="px-6 py-3 font-semibold">Email</th>
                            <th class="px-6 py-3 font-semibold">Téléphone</th>
                            <th class="px-6 py-3 font-semibold">Rôle</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staff as $user)
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $user->name }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->email }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $user->phone ?: '—' }}</td>
                                <td class="px-6 py-3.5">
                                    <div class="flex flex-wrap items-center gap-1.5">
                                        <x-ui.badge :label="$user->workflow_role === 'doctor' ? 'Médecin' : 'CNAMGS'" />
                                        @if ($user->suspended_at)
                                            <span class="inline-flex items-center rounded-full border border-accent-100 bg-accent-50 px-2.5 py-0.5 text-xs font-bold text-accent-700">Suspendu</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="#edit-staff-{{ $user->id }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Gérer</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-ink-muted">Aucun membre pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modifier / Supprimer --}}
        @if (count($staff))
            <div class="rounded-2xl border border-line bg-white shadow-card">
                <div class="border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">Modifier / supprimer</h3>
                </div>
                <div>
                    @foreach ($staff as $user)
                        <details id="edit-staff-{{ $user->id }}" class="group border-b border-line-subtle last:border-0">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4">
                                <span class="flex items-center gap-3">
                                    <span class="font-semibold text-ink">{{ $user->name }}</span>
                                    <x-ui.badge :label="$user->workflow_role === 'doctor' ? 'Médecin' : 'CNAMGS'" />
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="space-y-5 border-t border-line-subtle bg-canvas px-6 py-5">
                                <form method="POST" action="{{ url('admin/staff/' . $user->id) }}">
                                    @csrf
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Nom complet <span class="text-accent-600">*</span></label>
                                            <input type="text" name="name" value="{{ $user->name }}" required
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Email <span class="text-accent-600">*</span></label>
                                            <input type="email" name="email" value="{{ $user->email }}" required
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                                            <input type="text" name="phone" value="{{ $user->phone }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Rôle <span class="text-accent-600">*</span></label>
                                            <select name="workflow_role" required
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <option value="doctor" @selected($user->workflow_role === 'doctor')>Médecin</option>
                                                <option value="cnamgs" @selected($user->workflow_role === 'cnamgs')>CNAMGS</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Spécialité</label>
                                            <input type="text" name="specialty" value="{{ $user->specialty }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">N° professionnel</label>
                                            <input type="text" name="license_number" value="{{ $user->license_number }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Institution / établissement</label>
                                            <input type="text" name="institution" value="{{ $user->institution }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Mot de passe</label>
                                            <input type="password" name="password" minlength="8"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                            <p class="mt-1 text-xs text-ink-muted">Laisser vide pour ne pas changer.</p>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                                    </div>
                                </form>

                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-line bg-white px-4 py-3">
                                    @if ($user->suspended_at)
                                        <p class="text-sm text-ink-muted">Ce compte est <span class="font-semibold text-accent-700">suspendu</span> — il ne peut plus se connecter.</p>
                                        <form method="POST" action="{{ url('admin/staff/' . $user->id) }}">
                                            @csrf
                                            <input type="hidden" name="reactivate" value="1">
                                            <button type="submit" class="inline-flex min-h-[40px] items-center justify-center rounded-lg bg-success-600 px-4 text-sm font-bold text-white transition-colors hover:bg-success-700">Rétablir l'accès</button>
                                        </form>
                                    @else
                                        <p class="text-sm text-ink-muted">Suspendre coupe l'accès sans supprimer les dossiers traités.</p>
                                        <form method="POST" action="{{ url('admin/staff/' . $user->id) }}">
                                            @csrf
                                            <input type="hidden" name="suspend" value="1">
                                            <button type="submit" class="inline-flex min-h-[40px] items-center justify-center rounded-lg bg-warning-500 px-4 text-sm font-bold text-white transition-colors hover:bg-warning-600">Suspendre l'accès</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-accent-100 bg-accent-50/40 px-4 py-3">
                                    <p class="text-sm text-ink-muted">Suppression définitive (préférer la suspension).</p>
                                    <form method="POST" action="{{ url('admin/staff/' . $user->id) }}"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">
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
