@extends('layouts.public')

@section('title', 'Hôpitaux partenaires')

@section('content')

    {{-- ================= EN-TÊTE ================= --}}
    <section class="bg-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="max-w-3xl">
                <span class="eyebrow">Hôpitaux partenaires</span>
                <h1 class="mt-3 font-display text-3xl font-extrabold leading-[1.14] tracking-tight text-ink sm:text-[38px]">
                    Un réseau d'établissements de référence à l'étranger
                </h1>
                <p class="mt-4 text-lg leading-relaxed text-ink-muted">
                    Relief Services sélectionne des hôpitaux et cliniques de qualité en Tunisie, au Maroc,
                    en Afrique du Sud, en Turquie et en France. Chaque établissement est retenu pour son
                    plateau technique, ses spécialités médicales et chirurgicales et sa capacité à accueillir
                    les patients pris en charge.
                </p>
            </div>
        </div>
    </section>

    {{-- ================= GRILLE DES HÔPITAUX ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($hospitals as $hospital)
                    @php $sicks = $hospital->sicks; @endphp
                    <x-ui.card padding="p-0" class="group flex flex-col overflow-hidden">
                        {{-- Visuel --}}
                        <div class="relative h-44 overflow-hidden bg-gradient-to-br from-primary-100 to-primary-200/60">
                            @if ($hospital->picture_1)
                                <img src="{{ asset($hospital->picture_1) }}" alt="{{ $hospital->label }}" loading="lazy"
                                     class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                            @else
                                <div class="flex h-full w-full items-center justify-center">
                                    <svg class="h-10 w-10 text-primary-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M12 9v4"/><path d="M10 11h4"/><path d="M9 21v-4h6v4"/></svg>
                                </div>
                            @endif
                            @if ($hospital->country?->label)
                                <span class="absolute left-3 top-3 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-bold text-primary-700 shadow-card">
                                    {{ $hospital->country->label }}
                                </span>
                            @endif
                        </div>

                        {{-- Contenu --}}
                        <div class="flex flex-1 flex-col p-6">
                            <h2 class="font-display text-lg font-bold text-ink">{{ $hospital->label }}</h2>

                            <div class="mt-1.5 inline-flex items-center gap-1.5 text-sm text-ink-muted">
                                <svg class="h-4 w-4 shrink-0 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ collect([$hospital->town?->label, $hospital->country?->label])->filter()->implode(', ') ?: 'Destination à confirmer' }}
                            </div>

                            @if ($hospital->description)
                                <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-ink-muted">{{ $hospital->description }}</p>
                            @endif

                            @if ($sicks->count())
                                <div class="mt-4">
                                    <div class="eyebrow mb-2 text-ink-faint">Spécialités</div>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($sicks->take(5) as $sick)
                                            <x-ui.badge :label="$sick->label" />
                                        @endforeach
                                        @if ($sicks->count() > 5)
                                            <span class="inline-flex items-center rounded-full border border-line bg-canvas px-3 py-1 text-xs font-bold text-ink-muted">
                                                +{{ $sicks->count() - 5 }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </x-ui.card>
                @empty
                    <x-ui.card class="sm:col-span-2 lg:col-span-3" padding="p-8">
                        <div class="mx-auto max-w-lg text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-primary-50 text-primary-500">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M12 9v4"/><path d="M10 11h4"/><path d="M9 21v-4h6v4"/></svg>
                            </div>
                            <h2 class="mt-4 font-display text-xl font-bold text-ink">Nos hôpitaux partenaires arrivent bientôt</h2>
                            <p class="mt-2 text-sm leading-relaxed text-ink-muted">
                                La liste de nos établissements partenaires est en cours de mise à jour. En attendant,
                                demandez un devis et nous vous orienterons vers la destination la plus adaptée.
                            </p>
                            <div class="mt-6 flex justify-center">
                                <x-ui.button variant="primary" href="{{ route('quote') }}">Demander un devis</x-ui.button>
                            </div>
                        </div>
                    </x-ui.card>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================= CTA FINAL ================= --}}
    <section class="bg-primary-900">
        <div class="mx-auto flex max-w-container flex-col items-center gap-6 px-4 py-16 text-center lg:px-6">
            <div class="brand-line max-w-[120px]"></div>
            <h2 class="font-display text-3xl font-extrabold text-white sm:text-4xl">Un établissement vous intéresse&nbsp;?</h2>
            <p class="max-w-xl text-primary-100">
                Obtenez un devis gratuit et sans engagement : nous vous orientons vers l'hôpital partenaire
                le plus adapté à votre prise en charge.
            </p>
            <div class="mt-2">
                <x-ui.button variant="accent" href="{{ route('quote') }}">Demander un devis</x-ui.button>
            </div>
        </div>
    </section>

@endsection
