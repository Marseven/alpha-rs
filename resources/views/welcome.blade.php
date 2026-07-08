@extends('layouts.public')

@section('title', 'Se faire soigner à l’étranger')
@section('meta_description', "Relief Services facilite votre évacuation sanitaire et vos soins à l'étranger depuis le Gabon : devis gratuit, prise en charge CNAMGS, rendez-vous médicaux, logement et suivi de dossier en ligne.")

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

            @php $heroImages = array_map(fn ($n) => asset("media/stories/img-$n.jpg"), range(1, 7)); @endphp
            <div class="relative h-80 overflow-hidden rounded-3xl border border-line bg-primary-100 shadow-card sm:h-[460px]">
                @foreach ($heroImages as $i => $img)
                    <img src="{{ $img }}" alt="Relief Services — accompagnement médical" data-hero-slide
                         class="absolute inset-0 h-full w-full object-cover transition-opacity duration-700 ease-out {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                @endforeach
                <span class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-ink/45 to-transparent"></span>
                <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 items-center gap-1.5" data-hero-dots></div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        (function () {
            const slides = Array.from(document.querySelectorAll('[data-hero-slide]'));
            const dotsC = document.querySelector('[data-hero-dots]');
            if (slides.length < 2 || !dotsC) return;
            let i = 0;
            slides.forEach((_, k) => {
                const d = document.createElement('span');
                d.className = 'h-1.5 rounded-full transition-all ' + (k === 0 ? 'w-5 bg-white' : 'w-1.5 bg-white/50');
                dotsC.appendChild(d);
            });
            const dots = dotsC.children;
            function show(n) {
                slides.forEach((s, k) => s.style.opacity = k === n ? '1' : '0');
                Array.from(dots).forEach((d, k) => { d.className = 'h-1.5 rounded-full transition-all ' + (k === n ? 'w-5 bg-white' : 'w-1.5 bg-white/50'); });
            }
            if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            setInterval(function () { i = (i + 1) % slides.length; show(i); }, 4000);
        })();
    </script>
    @endpush

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

    {{-- ================= OUTILS EN LIGNE ================= --}}
    <section class="bg-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 max-w-2xl">
                <span class="eyebrow">Vos outils en ligne</span>
                <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Un suivi digital, du début à la fin</h2>
                <p class="mt-3 text-ink-muted">Médecins, patients et CNAMGS collaborent sur une même plateforme — et notre assistant répond à vos questions à toute heure.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <x-ui.card padding="p-7" class="flex flex-col">
                    <span class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-50 text-primary-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 2v2M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/></svg>
                    </span>
                    <h3 class="font-display text-lg font-bold text-ink">Espace médecin</h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-ink-muted">Les médecins suivent leurs dossiers et les transmettent à la CNAMGS en ligne, étape par étape, en toute confidentialité.</p>
                    <a href="{{ route('login') }}" class="mt-4 font-semibold text-primary-600 hover:text-primary-700">Accéder à mon espace →</a>
                </x-ui.card>

                <x-ui.card padding="p-7" class="flex flex-col">
                    <span class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-success-50 text-success-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    </span>
                    <h3 class="font-display text-lg font-bold text-ink">Suivi en temps réel</h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-ink-muted">Suivez l'avancement de votre prise en charge avec votre numéro de dossier — de la transmission CNAMGS jusqu'à l'évacuation.</p>
                    <a href="{{ route('track.form') }}" class="mt-4 font-semibold text-primary-600 hover:text-primary-700">Suivre mon dossier →</a>
                </x-ui.card>

                <x-ui.card padding="p-7" class="flex flex-col">
                    <span class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-accent-50 text-accent-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01M12 10h.01M16 10h.01"/></svg>
                    </span>
                    <h3 class="font-display text-lg font-bold text-ink">Assistant en ligne 24/7</h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-ink-muted">Une question sur nos services, un devis ou une destination ? Notre assistant vous répond immédiatement.</p>
                    <button type="button" onclick="if(window.rsChatOpen){rsChatOpen()}else{location.href='{{ route('assistant.form') }}'}" class="mt-4 text-left font-semibold text-primary-600 hover:text-primary-700">Discuter maintenant →</button>
                </x-ui.card>
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
                            <div class="h-40 overflow-hidden bg-gradient-to-br from-primary-100 to-primary-200/60">
                                @if ($town->picture)
                                    <img src="{{ asset($town->picture) }}" alt="{{ $town->label }}" loading="lazy" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-10 w-10 text-primary-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                @endif
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

    {{-- ================= STORIES (vidéos + images) ================= --}}
    @php
        $stories = array_map(fn ($n) => ['type' => 'video', 'src' => asset("media/stories/vid-$n.mp4")], range(1, 4));
    @endphp
    <section class="bg-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-8 max-w-2xl">
                <span class="eyebrow">En vidéo</span>
                <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Relief Services en action</h2>
                <p class="mt-3 text-ink-muted">Le quotidien de nos accompagnements en vidéo — touchez une story pour la lancer.</p>
            </div>

            <div class="flex snap-x gap-4 overflow-x-auto pb-4 [scrollbar-width:thin]">
                @foreach ($stories as $i => $story)
                    <button type="button" onclick="rsOpenStory({{ $i }})"
                        class="group relative aspect-[9/16] w-40 flex-none snap-start overflow-hidden rounded-2xl border border-line bg-primary-100 shadow-card ring-2 ring-transparent transition hover:ring-primary-300 sm:w-48">
                        @if ($story['type'] === 'video')
                            <video class="h-full w-full object-cover" muted playsinline preload="metadata" src="{{ $story['src'] }}#t=0.1"></video>
                            <span class="absolute inset-0 flex items-center justify-center">
                                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white/85 text-primary-700 shadow-lg backdrop-blur">
                                    <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </span>
                        @else
                            <img class="h-full w-full object-cover transition duration-300 group-hover:scale-105" src="{{ $story['src'] }}" alt="Relief Services" loading="lazy">
                        @endif
                        <span class="pointer-events-none absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-ink/70 to-transparent"></span>
                        <span class="absolute bottom-2 left-3 font-mono text-[10px] font-semibold uppercase tracking-wide text-white/90">{{ $story['type'] === 'video' ? 'Vidéo' : 'Photo' }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Story viewer (plein écran, clavier + tap) --}}
    <div id="rs-story-viewer" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/90 p-4" role="dialog" aria-modal="true" aria-label="Visionneuse de stories">
        <button type="button" onclick="rsCloseStory()" class="absolute right-4 top-4 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20" aria-label="Fermer">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
        <button type="button" onclick="rsPrevStory()" class="absolute left-2 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20 sm:left-6" aria-label="Précédent">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="m15 18-6-6 6-6"/></svg>
        </button>
        <button type="button" onclick="rsNextStory()" class="absolute right-2 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20 sm:right-6" aria-label="Suivant">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="m9 18 6-6-6-6"/></svg>
        </button>
        <div class="flex aspect-[9/16] max-h-[88vh] w-full max-w-[420px] items-center justify-center overflow-hidden rounded-2xl bg-black">
            <div id="rs-story-stage" class="h-full w-full"></div>
        </div>
        <div id="rs-story-dots" class="absolute bottom-5 flex items-center gap-1.5"></div>
    </div>

    @push('scripts')
    <script>
        (function () {
            const stories = @json($stories);
            let idx = 0;
            const viewer = document.getElementById('rs-story-viewer');
            const stage = document.getElementById('rs-story-stage');
            const dots = document.getElementById('rs-story-dots');
            if (!viewer) return;

            function render() {
                const s = stories[idx];
                stage.innerHTML = '';
                if (s.type === 'video') {
                    const v = document.createElement('video');
                    v.src = s.src; v.controls = true; v.autoplay = true; v.playsInline = true;
                    v.className = 'h-full w-full object-contain bg-black';
                    stage.appendChild(v);
                } else {
                    const img = document.createElement('img');
                    img.src = s.src; img.alt = 'Relief Services';
                    img.className = 'h-full w-full object-contain';
                    stage.appendChild(img);
                }
                dots.innerHTML = stories.map((_, i) =>
                    '<span class="h-1.5 rounded-full ' + (i === idx ? 'w-5 bg-white' : 'w-1.5 bg-white/40') + '"></span>'
                ).join('');
            }
            window.rsOpenStory = function (i) { idx = i; viewer.classList.remove('hidden'); viewer.classList.add('flex'); document.body.style.overflow = 'hidden'; render(); };
            window.rsCloseStory = function () { viewer.classList.add('hidden'); viewer.classList.remove('flex'); document.body.style.overflow = ''; stage.innerHTML = ''; };
            window.rsNextStory = function () { idx = (idx + 1) % stories.length; render(); };
            window.rsPrevStory = function () { idx = (idx - 1 + stories.length) % stories.length; render(); };
            viewer.addEventListener('click', function (e) { if (e.target === viewer) window.rsCloseStory(); });
            document.addEventListener('keydown', function (e) {
                if (viewer.classList.contains('hidden')) return;
                if (e.key === 'Escape') window.rsCloseStory();
                if (e.key === 'ArrowRight') window.rsNextStory();
                if (e.key === 'ArrowLeft') window.rsPrevStory();
            });
        })();
    </script>
    @endpush

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
