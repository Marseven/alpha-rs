@extends('layouts.public')

@section('title', 'Se faire soigner à l’étranger')

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="bg-gradient-to-b from-primary-50/60 to-white">
        <div class="mx-auto grid max-w-container items-center gap-12 px-4 py-16 lg:grid-cols-2 lg:px-6 lg:py-20">
            <div class="flex flex-col gap-6">
                <span class="eyebrow">Assistance médicale — Évacuation sanitaire</span>
                <h1 class="font-display text-4xl font-extrabold leading-[1.12] tracking-tight text-ink sm:text-5xl">
                    Se faire soigner à l'étranger, en toute confiance.
                </h1>
                <p class="max-w-xl text-lg leading-relaxed text-ink-muted">
                    Relief Services facilite votre prise en charge : démarches administratives, rendez-vous
                    médicaux, logement et transport — du devis jusqu'au retour.
                </p>
                <div class="mt-1 flex flex-wrap gap-3">
                    <x-ui.button variant="accent" href="{{ route('quote') }}">
                        Demander un devis
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </x-ui.button>
                    <x-ui.button variant="outline" href="{{ route('simulator') }}">Simuler ma prise en charge</x-ui.button>
                </div>
                <div class="mt-4 flex flex-wrap gap-x-7 gap-y-3 border-t border-line pt-5 text-[13.5px] font-semibold text-ink">
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="#178A47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                        Prise en charge CNAMGS
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="#1568B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Paiement en ligne sécurisé
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="#1568B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Assistance 24h/7j
                    </span>
                </div>
            </div>

            <div class="relative flex h-72 items-center justify-center overflow-hidden rounded-3xl border border-line bg-gradient-to-br from-primary-100 via-primary-200/70 to-primary-100 sm:h-[420px]">
                <img src="{{ asset('images/LogoRSA.png') }}" alt="Relief Services" class="h-24 w-auto opacity-90">
            </div>
        </div>
    </section>

    {{-- ================= BANDEAU CHIFFRES ================= --}}
    <section class="border-y border-line bg-white">
        <div class="mx-auto grid max-w-container grid-cols-2 gap-8 px-4 py-10 lg:grid-cols-4 lg:px-6">
            <x-ui.stat value="8 ans" label="d'assistance sanitaire" />
            <x-ui.stat value="5 pays" label="de destination sélectionnés" />
            <x-ui.stat value="24h/7j" label="équipe d'assistance dédiée" />
            <x-ui.stat value="100%" label="secret professionnel garanti" />
        </div>
    </section>

    {{-- ================= SERVICES / FORMULES ================= --}}
    <section id="services" class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 flex flex-wrap items-end justify-between gap-4">
                <div class="max-w-2xl">
                    <span class="eyebrow">Nos services</span>
                    <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Un accompagnement complet</h2>
                    <p class="mt-3 text-ink-muted">
                        De la prise de rendez-vous à l'assistance sur place, choisissez le niveau
                        d'accompagnement adapté à votre situation. Le devis est gratuit et sans engagement.
                    </p>
                </div>
                <a href="{{ route('quote') }}" class="font-semibold text-primary-600 hover:text-primary-700">Demander un devis →</a>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @forelse ($services as $service)
                    <x-ui.card :featured="$loop->index === 1" padding="p-7" class="flex flex-col">
                        @if ($loop->index === 1)
                            <span class="eyebrow mb-3 text-accent-600">Recommandée</span>
                        @endif
                        <h3 class="font-display text-2xl font-extrabold text-ink">{{ $service->label }}</h3>
                        <div class="mt-3 flex items-baseline gap-1.5">
                            <span class="font-display text-3xl font-extrabold text-ink">{{ number_format((float) $service->price, 0, ',', ' ') }}</span>
                            <span class="font-mono text-sm text-ink-muted">XAF</span>
                        </div>
                        @if ($service->description)
                            <p class="mt-4 flex-1 text-sm leading-relaxed text-ink-muted">{{ $service->description }}</p>
                        @endif
                        <div class="mt-6">
                            <x-ui.button :variant="$loop->index === 1 ? 'accent' : 'primary'" href="{{ route('quote') }}" class="w-full">
                                Choisir {{ $service->label }}
                            </x-ui.button>
                        </div>
                    </x-ui.card>
                @empty
                    <x-ui.card class="md:col-span-2">
                        <p class="text-ink-muted">Nos formules seront bientôt disponibles. <a href="{{ route('quote') }}" class="font-semibold text-primary-600">Demandez un devis personnalisé</a>.</p>
                    </x-ui.card>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================= PARCOURS ================= --}}
    <section class="bg-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 max-w-2xl">
                <span class="eyebrow">Votre parcours</span>
                <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">De la demande au retour, en 4 étapes</h2>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['01', 'Demande de devis', 'Décrivez votre besoin en ligne ; réponse sous 48h avec un devis détaillé.'],
                    ['02', 'Constitution du dossier', 'Passeport, rapport médical et examens transmis en toute confidentialité.'],
                    ['03', 'Validation CNAMGS', "Suivi transparent de l'examen de votre prise en charge, étape par étape."],
                    ['04', 'Évacuation & suivi', "Voyage, séjour et rendez-vous organisés ; assistance jusqu'au retour."],
                ] as [$num, $t, $d])
                    <x-ui.card padding="p-6">
                        <div class="font-mono text-2xl font-semibold text-primary-300">{{ $num }}</div>
                        <h3 class="mt-3 font-display text-lg font-bold text-ink">{{ $t }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-muted">{{ $d }}</p>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= SPÉCIALITÉS ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-8 max-w-2xl">
                <span class="eyebrow">Les spécialités</span>
                <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Les maladies que nous prenons en charge</h2>
                <p class="mt-3 text-ink-muted">
                    Nos hôpitaux partenaires en Tunisie, au Maroc, en Afrique du Sud, en Turquie et en France
                    couvrent les grandes spécialités médicales et chirurgicales.
                </p>
            </div>
            @if ($sicks->count())
                <div class="flex flex-wrap gap-3">
                    @foreach ($sicks as $sick)
                        <span class="inline-flex items-center gap-2 rounded-full border border-line bg-white px-4 py-2 text-sm font-semibold text-ink shadow-card">
                            <svg class="h-4 w-4 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/></svg>
                            {{ $sick->label }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ================= DESTINATIONS ================= --}}
    <section class="bg-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 flex flex-wrap items-end justify-between gap-4">
                <div class="max-w-2xl">
                    <span class="eyebrow">Nos destinations</span>
                    <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Des villes et hôpitaux de qualité</h2>
                </div>
                <a href="{{ route('list-hospitals') }}" class="font-semibold text-primary-600 hover:text-primary-700">Tous les hôpitaux partenaires →</a>
            </div>
            @if ($towns->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($towns as $town)
                        <div class="group overflow-hidden rounded-2xl border border-line bg-white shadow-card">
                            <div class="flex h-40 items-center justify-center bg-gradient-to-br from-primary-100 to-primary-200/60">
                                <svg class="h-10 w-10 text-primary-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="p-5">
                                <div class="font-display text-lg font-bold text-ink">{{ $town->label }}</div>
                                <div class="mt-1 text-sm text-ink-muted">{{ $town->country->label ?? '' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ================= TÉMOIGNAGES ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 max-w-2xl">
                <span class="eyebrow">Témoignages</span>
                <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Un seul objectif : vous satisfaire</h2>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['« Je recommande Relief Services pour vos futurs déplacements vers la Turquie dans le cadre d\'un tourisme médical. »', 'HM', 'Hubert Minko', 'Client · Istanbul'],
                    ['« Grâce à Relief Services, j\'ai pu me soigner au Maroc, et il est désormais très simple de suivre mon dossier médical en ligne. »', 'CM', 'Carla Mbadinga', 'Patiente · Rabat'],
                    ['« L\'assistance et le suivi de Relief Services m\'ont permis de trouver la meilleure destination pour soigner ma fille. »', 'JA', 'Jean Aliangha', 'Client · Tunis'],
                ] as [$quote, $initials, $name, $role])
                    <x-ui.card padding="p-7" class="flex flex-col">
                        <p class="flex-1 text-[15px] leading-relaxed text-ink">{{ $quote }}</p>
                        <div class="mt-6 flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-primary-600 font-display text-sm font-bold text-white">{{ $initials }}</div>
                            <div>
                                <div class="font-bold text-ink">{{ $name }}</div>
                                <div class="text-xs text-ink-muted">{{ $role }}</div>
                            </div>
                        </div>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= CTA FINAL ================= --}}
    <section class="bg-primary-900">
        <div class="mx-auto flex max-w-container flex-col items-center gap-6 px-4 py-16 text-center lg:px-6">
            <div class="brand-line max-w-[120px]"></div>
            <h2 class="font-display text-3xl font-extrabold text-white sm:text-4xl">Prêt à organiser votre prise en charge&nbsp;?</h2>
            <p class="max-w-xl text-primary-100">Obtenez un devis gratuit et sans engagement, ou simulez votre prise en charge en quelques minutes.</p>
            <div class="mt-2 flex flex-wrap justify-center gap-3">
                <x-ui.button variant="accent" href="{{ route('quote') }}">Demander un devis</x-ui.button>
                <a href="{{ route('simulator') }}" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-lg border-[1.5px] border-white/40 px-5 text-[15px] font-bold text-white transition-colors duration-150 hover:bg-white/10">Simuler ma prise en charge</a>
            </div>
        </div>
    </section>

@endsection
