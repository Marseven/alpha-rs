@extends('layouts.backoffice')

@section('title', 'Base de connaissances')
@section('page_title', 'Base de connaissances')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-8">

        {{-- En-tête --}}
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="eyebrow">Assistant IA</span>
                <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Base de connaissances</h2>
                <p class="mt-1 max-w-2xl text-sm text-ink-muted">
                    Ces entrées alimentent le chatbot. Une question dont le texte contient l'un des mots-clés reçoit
                    la réponse associée instantanément ; sinon, l'assistant IA s'appuie sur ces réponses comme contexte.
                </p>
            </div>
        </div>

        {{-- Ajouter une entrée --}}
        <div class="rounded-2xl border border-line bg-white shadow-card">
            <details class="group">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4 font-display text-base font-bold text-ink">
                    <span class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                        Ajouter une entrée
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="border-t border-line px-6 py-5">
                    <form method="POST" action="{{ url('admin/assistant-knowledge') }}">
                        @csrf
                        <div class="grid gap-4">
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">
                                    Question <span class="text-accent-600">*</span>
                                </label>
                                <input type="text" name="question" value="{{ old('question') }}" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">
                                    Réponse <span class="text-accent-600">*</span>
                                </label>
                                <textarea name="answer" rows="4" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ old('answer') }}</textarea>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Mots-clés</label>
                                <input type="text" name="keywords" value="{{ old('keywords') }}"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                <p class="mt-1.5 text-xs text-ink-muted">mots-clés séparés par des virgules ; si renseignés, une question contenant un de ces mots reçoit cette réponse instantanément</p>
                            </div>
                            <div>
                                <label class="flex items-start gap-3 text-sm text-ink">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                           class="mt-0.5 h-5 w-5 rounded border-[1.5px] border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    <span>Entrée active (utilisée par le chatbot)</span>
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
                <h3 class="font-display text-base font-bold text-ink">Entrées</h3>
                <span class="text-sm text-ink-muted">{{ count($entries) }} entrée(s)</span>
            </div>
            <div class="overflow-x-auto">
                <table data-datatable class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-line bg-canvas text-[11.5px] uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-semibold">Question</th>
                            <th class="px-6 py-3 font-semibold">Mots-clés</th>
                            <th class="px-6 py-3 font-semibold">Actif</th>
                            <th class="px-6 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($entries as $entry)
                            <tr class="border-b border-line-subtle last:border-0 hover:bg-canvas">
                                <td class="px-6 py-3.5 font-medium text-ink">{{ \Illuminate\Support\Str::limit($entry->question, 80) }}</td>
                                <td class="px-6 py-3.5 text-ink-muted">
                                    @if ($entry->keywords)
                                        <span class="font-mono text-[13px]">{{ \Illuminate\Support\Str::limit($entry->keywords, 50) }}</span>
                                    @else
                                        <span class="text-ink-muted">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3.5">
                                    @if ($entry->is_active)
                                        <x-ui.badge status="READY" label="Actif" />
                                    @else
                                        <x-ui.badge status="DRAFT" label="Inactif" />
                                    @endif
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="#edit-entry-{{ $entry->id }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Gérer</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-ink-muted">Aucune entrée pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modifier / Supprimer --}}
        @if (count($entries))
            <div class="rounded-2xl border border-line bg-white shadow-card">
                <div class="border-b border-line px-6 py-4">
                    <h3 class="font-display text-base font-bold text-ink">Modifier / supprimer</h3>
                </div>
                <div>
                    @foreach ($entries as $entry)
                        <details id="edit-entry-{{ $entry->id }}" class="group border-b border-line-subtle last:border-0">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-4">
                                <span class="flex items-center gap-3">
                                    <span class="font-semibold text-ink">{{ \Illuminate\Support\Str::limit($entry->question, 70) }}</span>
                                    @if ($entry->is_active)
                                        <x-ui.badge status="READY" label="Actif" />
                                    @else
                                        <x-ui.badge status="DRAFT" label="Inactif" />
                                    @endif
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="space-y-5 border-t border-line-subtle bg-canvas px-6 py-5">
                                <form method="POST" action="{{ url('admin/assistant-knowledge/' . $entry->id) }}">
                                    @csrf
                                    <div class="grid gap-4">
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">
                                                Question <span class="text-accent-600">*</span>
                                            </label>
                                            <input type="text" name="question" value="{{ $entry->question }}" required
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">
                                                Réponse <span class="text-accent-600">*</span>
                                            </label>
                                            <textarea name="answer" rows="4" required
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ $entry->answer }}</textarea>
                                        </div>
                                        <div>
                                            <label class="mb-1.5 block text-sm font-semibold text-ink">Mots-clés</label>
                                            <input type="text" name="keywords" value="{{ $entry->keywords }}"
                                                class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                            <p class="mt-1.5 text-xs text-ink-muted">mots-clés séparés par des virgules ; si renseignés, une question contenant un de ces mots reçoit cette réponse instantanément</p>
                                        </div>
                                        <div>
                                            <label class="flex items-start gap-3 text-sm text-ink">
                                                <input type="checkbox" name="is_active" value="1" {{ $entry->is_active ? 'checked' : '' }}
                                                       class="mt-0.5 h-5 w-5 rounded border-[1.5px] border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                                <span>Entrée active (utilisée par le chatbot)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                                    </div>
                                </form>

                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-line bg-white px-4 py-3">
                                    <p class="text-sm text-ink-muted">Êtes-vous sûr de vouloir supprimer cette entrée ?</p>
                                    <form method="POST" action="{{ url('admin/assistant-knowledge/' . $entry->id) }}" onsubmit="return confirm('Supprimer définitivement cette entrée ?');">
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
