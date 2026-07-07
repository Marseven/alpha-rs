@extends('layouts.backoffice')

@section('title', 'Dossiers médicaux')
@section('page_title', 'Dossiers médicaux')

@php
    // Palette de badge (couleur uniquement) déduite du "type" bootstrap legacy ;
    // le libellé FR reste piloté par Controller::status()['message'].
    $badgeToneKey = [
        'primary'   => 'RECEIVED_BY_CNAMGS',
        'info'      => 'RECEIVED_BY_CNAMGS',
        'warning'   => 'IN_REVIEW',
        'success'   => 'READY',
        'danger'    => 'MISSING_INFORMATION',
        'secondary' => 'DRAFT',
    ];
@endphp

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div>
            <span class="eyebrow">Activité</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Dossiers médicaux</h2>
            <p class="mt-1 text-sm text-ink-muted">Gestion des dossiers médicaux et des évacuations sanitaires.</p>
        </div>

        {{-- KPIs --}}
        <div class="grid gap-5 sm:grid-cols-3">
            <x-ui.stat-card label="Total dossiers" :value="$folders->count()" tone="primary"
                icon="M4 4h6l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
            <x-ui.stat-card label="En attente" :value="$folders->where('status', STATUT_PENDING)->count()" tone="warning"
                icon="M12 6v6l4 2M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" />
            <x-ui.stat-card label="Traités" :value="$folders->where('status', STATUT_DO)->count()" tone="success"
                icon="M22 11.08V12a10 10 0 1 1-5.93-9.14M22 4 12 14.01l-3-3" />
        </div>

        {{-- Tableau --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-line px-6 py-4">
                <h3 class="font-display text-base font-bold text-ink">Liste des dossiers médicaux</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[840px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Nom complet</th>
                            <th class="px-6 py-3 font-semibold">Date de naissance</th>
                            <th class="px-6 py-3 font-semibold">Genre</th>
                            <th class="px-6 py-3 font-semibold">Téléphone</th>
                            <th class="px-6 py-3 font-semibold">Statut</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($folders as $folder)
                            @php
                                $status = \App\Http\Controllers\Controller::status($folder->status) ?? ['type' => 'secondary', 'message' => '—'];
                                $toneKey = $badgeToneKey[$status['type']] ?? 'DRAFT';
                            @endphp
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-mono text-[13px] text-ink-muted">{{ $folder->id }}</td>
                                <td class="px-6 py-3.5 font-medium text-ink">{{ $folder->lastname . ' ' . $folder->firstname }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $folder->birthday }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $folder->gender }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">{{ $folder->phone }}</td>
                                <td class="px-6 py-3.5">
                                    <x-ui.badge :status="$toneKey" :label="$status['message']" />
                                </td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('files.folder', ['folder' => $folder->id, 'field' => 'piece']) }}"
                                           title="Télécharger la pièce"
                                           class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-ink-muted transition-colors hover:border-primary-300 hover:bg-primary-50 hover:text-primary-600">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                                        </a>
                                        <button type="button" title="Voir" onclick="rsOpenModal('modal-view-folder-{{ $folder->id }}')"
                                           class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-ink-muted transition-colors hover:border-primary-300 hover:bg-primary-50 hover:text-primary-600">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </button>
                                        <button type="button" title="Modifier" onclick="rsOpenModal('modal-edit-folder-{{ $folder->id }}')"
                                           class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-ink-muted transition-colors hover:border-primary-300 hover:bg-primary-50 hover:text-primary-600">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                        </button>
                                        <button type="button" title="Supprimer" onclick="rsOpenModal('modal-delete-folder-{{ $folder->id }}')"
                                           class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-ink-muted transition-colors hover:border-accent-100 hover:bg-accent-50 hover:text-accent-600">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-10 text-center text-ink-muted">Aucun dossier médical pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modales --}}
    @foreach ($folders as $folder)
        {{-- Voir --}}
        <div id="modal-view-folder-{{ $folder->id }}" data-rs-modal class="fixed inset-0 z-50 hidden items-center justify-center p-4">
            <div class="absolute inset-0 bg-ink/40 backdrop-blur-sm" onclick="rsCloseModal('modal-view-folder-{{ $folder->id }}')"></div>
            <div class="relative z-10 w-full max-w-2xl overflow-hidden rounded-2xl border border-line bg-white shadow-card">
                <div class="flex items-center justify-between border-b border-line px-6 py-4">
                    <div>
                        <span class="eyebrow">Informations du dossier</span>
                        <h3 class="mt-1 font-mono text-sm font-bold text-primary-600">{{ $folder->reference }}</h3>
                    </div>
                    <button type="button" onclick="rsCloseModal('modal-view-folder-{{ $folder->id }}')" class="text-ink-faint transition-colors hover:text-ink" aria-label="Fermer">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="grid gap-5 px-6 py-6 sm:grid-cols-2">
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Nom &amp; prénom</div>
                        <p class="mt-1 text-sm font-medium text-ink">{{ $folder->firstname }} {{ $folder->lastname }}</p>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Contacts</div>
                        <p class="mt-1 text-sm text-ink">{{ $folder->email }} — {{ $folder->phone }}</p>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Date de naissance</div>
                        <p class="mt-1 text-sm text-ink">{{ $folder->birthday }}</p>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Catégorie</div>
                        <p class="mt-1 text-sm text-ink">{{ $folder->category }}</p>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Service</div>
                        <p class="mt-1 text-sm text-ink">{{ $folder->service?->label ?? '—' }}</p>
                    </div>
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Pays</div>
                        <p class="mt-1 text-sm text-ink">{{ $folder->country?->label ?? '—' }}</p>
                    </div>
                    <div class="sm:col-span-2 border-t border-line-subtle pt-4">
                        <div class="font-mono text-[11px] uppercase tracking-wide text-ink-faint">Pièce jointe</div>
                        <a href="{{ route('files.folder', ['folder' => $folder->id, 'field' => 'piece']) }}"
                           class="mt-1 inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600 hover:text-primary-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                            Télécharger la pièce
                        </a>
                    </div>
                </div>
                <div class="flex justify-end border-t border-line px-6 py-4">
                    <x-ui.button variant="ghost" type="button" onclick="rsCloseModal('modal-view-folder-{{ $folder->id }}')">Fermer</x-ui.button>
                </div>
            </div>
        </div>

        {{-- Modifier --}}
        <div id="modal-edit-folder-{{ $folder->id }}" data-rs-modal class="fixed inset-0 z-50 hidden items-center justify-center p-4">
            <div class="absolute inset-0 bg-ink/40 backdrop-blur-sm" onclick="rsCloseModal('modal-edit-folder-{{ $folder->id }}')"></div>
            <div class="relative z-10 w-full max-w-lg overflow-hidden rounded-2xl border border-line bg-white shadow-card">
                <form action="{{ url('admin/folder-state/' . $folder->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-between border-b border-line px-6 py-4">
                        <h3 class="font-display text-base font-bold text-ink">Modifier un dossier</h3>
                        <button type="button" onclick="rsCloseModal('modal-edit-folder-{{ $folder->id }}')" class="text-ink-faint transition-colors hover:text-ink" aria-label="Fermer">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="space-y-4 px-6 py-6">
                        <div>
                            <label for="price-folder-{{ $folder->id }}" class="mb-1.5 block text-sm font-semibold text-ink">Prix de l'évacuation</label>
                            <input id="price-folder-{{ $folder->id }}" type="number" name="price" value="{{ $folder->price }}"
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15" />
                        </div>
                        <div>
                            <label for="status-folder-{{ $folder->id }}" class="mb-1.5 block text-sm font-semibold text-ink">Statut</label>
                            <select id="status-folder-{{ $folder->id }}" name="status"
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @php
                                    App\Http\Controllers\Controller::work_status();
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-line px-6 py-4">
                        <x-ui.button variant="ghost" type="button" onclick="rsCloseModal('modal-edit-folder-{{ $folder->id }}')">Annuler</x-ui.button>
                        <x-ui.button variant="primary" type="submit">Enregistrer</x-ui.button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Supprimer --}}
        <div id="modal-delete-folder-{{ $folder->id }}" data-rs-modal class="fixed inset-0 z-50 hidden items-center justify-center p-4">
            <div class="absolute inset-0 bg-ink/40 backdrop-blur-sm" onclick="rsCloseModal('modal-delete-folder-{{ $folder->id }}')"></div>
            <div class="relative z-10 w-full max-w-md overflow-hidden rounded-2xl border border-line bg-white shadow-card">
                <div class="flex items-center justify-between border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">Suppression</h3>
                    <button type="button" onclick="rsCloseModal('modal-delete-folder-{{ $folder->id }}')" class="text-ink-faint transition-colors hover:text-ink" aria-label="Fermer">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="px-6 py-6 text-sm text-ink-muted">
                    Êtes-vous sûr de vouloir supprimer ce dossier&nbsp;?
                </div>
                <div class="flex justify-end gap-3 border-t border-line px-6 py-4">
                    <x-ui.button variant="ghost" type="button" onclick="rsCloseModal('modal-delete-folder-{{ $folder->id }}')">Annuler</x-ui.button>
                    <form action="{{ url('admin/folder/' . $folder->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="delete" value="true">
                        <x-ui.button variant="accent" type="submit">Supprimer</x-ui.button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        function rsOpenModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.remove('hidden');
            el.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function rsCloseModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[data-rs-modal]:not(.hidden)').forEach(function (m) { rsCloseModal(m.id); });
            }
        });
    </script>
@endpush
