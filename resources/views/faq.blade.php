@extends('layouts.public')

@section('title', 'Foire aux questions')
@section('meta_description', "Questions fréquentes sur l'assistance médicale, les devis, le suivi de dossier et la prise en charge CNAMGS avec Relief Services.")

@section('content')
    {{-- ================= EN-TÊTE ================= --}}
    <section class="border-b border-line bg-gradient-to-b from-primary-50/60 to-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <span class="eyebrow">Foire aux questions</span>
            <h1 class="mt-3 font-display text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">
                Vos questions, nos réponses
            </h1>
            <p class="mt-4 max-w-2xl text-lg leading-relaxed text-ink-muted">
                L'essentiel pour comprendre comment obtenir un devis, suivre votre dossier et joindre nos équipes.
            </p>
        </div>
    </section>

    {{-- ================= ACCORDÉON ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-3xl px-4 py-16 lg:px-6 lg:py-20">
            <div class="space-y-4">
                <x-ui.card padding="p-0">
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 font-display text-[17px] font-bold text-ink">
                            Comment obtenir un devis ?
                            <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="border-t border-line px-6 py-5 text-[15px] leading-relaxed text-ink-muted">
                            Veuillez renseigner la rubrique devis en téléversant les documents demandés.
                        </div>
                    </details>
                </x-ui.card>

                <x-ui.card padding="p-0">
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 font-display text-[17px] font-bold text-ink">
                            Après combien de temps dois-je rentrer en possession du devis ?
                            <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="border-t border-line px-6 py-5 text-[15px] leading-relaxed text-ink-muted">
                            72H.
                        </div>
                    </details>
                </x-ui.card>

                <x-ui.card padding="p-0">
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 font-display text-[17px] font-bold text-ink">
                            Avec l'utilisation du simulateur peut-on obtenir le coût du séjour ?
                            <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="border-t border-line px-6 py-5 text-[15px] leading-relaxed text-ink-muted">
                            Tout dépendra des pathologies renseignées dans le moteur de recherche.
                        </div>
                    </details>
                </x-ui.card>

                <x-ui.card padding="p-0">
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 font-display text-[17px] font-bold text-ink">
                            Quel avantage d'utiliser le compte Espace Client ?
                            <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="border-t border-line px-6 py-5 text-[15px] leading-relaxed text-ink-muted">
                            Avoir un compte Espace Client permettra aux clients de suivre la procédure administrative de leur dossier.
                        </div>
                    </details>
                </x-ui.card>

                <x-ui.card padding="p-0">
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 font-display text-[17px] font-bold text-ink">
                            Comment entrer en contact avec un responsable ?
                            <svg class="h-5 w-5 shrink-0 text-primary-600 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="border-t border-line px-6 py-5 text-[15px] leading-relaxed text-ink-muted">
                            Nous avons mis en place un numéro WhatsApp pour des discussions instantanées.
                        </div>
                    </details>
                </x-ui.card>
            </div>

            {{-- Aide complémentaire --}}
            <div class="mt-10 flex flex-col items-start gap-4 rounded-2xl border border-line bg-white p-6 shadow-card sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-display text-lg font-bold text-ink">Vous ne trouvez pas votre réponse ?</h2>
                    <p class="mt-1 text-[15px] text-ink-muted">Notre équipe vous répond du devis jusqu'au retour.</p>
                </div>
                <x-ui.button variant="accent" href="{{ route('home') }}#contact">Nous contacter</x-ui.button>
            </div>
        </div>
    </section>
@endsection
