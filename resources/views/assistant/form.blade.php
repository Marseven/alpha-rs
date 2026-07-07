@extends('layouts.public')

@section('title', 'Assistant en ligne')

@section('content')
    {{-- ================= HERO ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-3xl px-4 py-16 lg:px-6 lg:py-20">
            <span class="eyebrow">Assistant en ligne</span>
            <h1 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-4xl">Vous avez une question ?</h1>
            <p class="mt-3 text-ink-muted">
                Posez votre question à l'assistant {{ config('relief.name') }} : prise en charge, devis,
                destinations ou suivi de dossier. Nous vous répondons au plus vite.
            </p>

            @if ($errors->any())
                <x-ui.alert type="danger" class="mt-6">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </x-ui.alert>
            @endif

            {{-- ================= RÉPONSE ================= --}}
            @isset($answer)
                <x-ui.card class="mt-8" :featured="true" padding="p-6 sm:p-7">
                    <span class="eyebrow text-accent-600">Réponse de l'assistant</span>

                    <div class="mt-4 rounded-xl border border-line bg-canvas px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-ink-faint">Votre question</div>
                        <p class="mt-1 text-[15px] text-ink">{{ $question }}</p>
                    </div>

                    <div class="mt-4">
                        <div class="text-xs font-semibold uppercase tracking-wide text-ink-faint">Réponse</div>
                        <p class="mt-1 whitespace-pre-line text-[15px] leading-relaxed text-ink">{{ $answer }}</p>
                    </div>

                    @if (config('relief.medical_disclaimer'))
                        <x-ui.alert type="warning" class="mt-5">
                            <svg class="mt-0.5 h-4 w-4 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                            <span>{{ config('relief.medical_disclaimer') }}</span>
                        </x-ui.alert>
                    @endif
                </x-ui.card>
            @endisset

            {{-- ================= FORMULAIRE ================= --}}
            <form method="POST" action="{{ route('assistant.ask') }}" class="mt-8">
                @csrf
                <x-ui.card padding="p-6 sm:p-7">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-semibold text-ink">Nom <span class="font-normal text-ink-faint">(optionnel)</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        </div>
                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone <span class="font-normal text-ink-faint">(optionnel)</span></label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="question" class="mb-1.5 block text-sm font-semibold text-ink">Votre question <span class="text-accent-600">*</span></label>
                        <textarea id="question" name="question" rows="4" required
                                  placeholder="Ex : Comment se déroule une prise en charge CNAMGS ?"
                                  class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ old('question') }}</textarea>
                    </div>

                    <div class="mt-5">
                        <x-ui.button type="submit" variant="accent" class="w-full sm:w-auto">Envoyer ma question</x-ui.button>
                    </div>
                </x-ui.card>
            </form>
        </div>
    </section>
@endsection
