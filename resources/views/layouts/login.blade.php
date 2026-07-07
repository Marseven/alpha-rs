<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace client') — Relief Services</title>

    <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('images/LogoRSA.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-full bg-canvas font-sans text-ink antialiased">
    <div class="flex min-h-screen flex-col lg:flex-row">

        {{-- Brand panel — navy, réassurance. Bandeau slim sur mobile, colonne pleine sur desktop. --}}
        <aside class="relative flex shrink-0 flex-col justify-between overflow-hidden bg-primary-900 px-6 py-5 text-primary-100 lg:w-[44%] lg:max-w-[560px] lg:px-12 lg:py-12">
            {{-- Halos décoratifs (pas de dégradé sur texte/bouton) --}}
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-primary-500/20 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-primary-700/40 blur-3xl" aria-hidden="true"></div>

            <div class="relative">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <img src="{{ asset('images/LogoRSA.png') }}" alt="Relief Services" class="h-11 w-auto lg:h-12">
                    <span class="font-display text-xl font-extrabold text-white">Relief Services</span>
                </a>

                {{-- Accroche + points de confiance (desktop uniquement) --}}
                <div class="mt-16 hidden lg:block">
                    <span class="eyebrow text-primary-300">Espace sécurisé</span>
                    <h2 class="mt-4 font-display text-3xl font-extrabold leading-tight text-white xl:text-[2.4rem]">
                        Votre prise en charge médicale, suivie en toute confiance.
                    </h2>
                    <div class="mt-5 h-1 w-16 rounded-full bg-brand-line"></div>
                    <p class="mt-5 max-w-md text-[15px] leading-relaxed text-primary-200">
                        Retrouvez vos dossiers, devis et évacuations sanitaires — du premier contact jusqu'au retour.
                    </p>

                    <ul class="mt-9 space-y-4 text-[15px] text-primary-100">
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/10 text-primary-100">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </span>
                            Suivi de dossier en temps réel, étape par étape.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/10 text-primary-100">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                            </span>
                            Données confidentielles, échanges sécurisés.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/10 text-primary-100">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                            </span>
                            Une équipe joignable à Libreville et Port-Gentil.
                        </li>
                    </ul>
                </div>
            </div>

            <p class="relative mt-8 hidden text-xs text-primary-300 lg:block">
                © {{ date('Y') }} Relief Services · Libreville · Port-Gentil, Gabon
            </p>
        </aside>

        {{-- Form panel — carte blanche centrée. --}}
        <main class="flex flex-1 items-center justify-center bg-canvas px-4 py-10 sm:px-6 lg:py-12">
            <div class="w-full max-w-md">
                <div class="overflow-hidden rounded-2xl border border-line bg-white shadow-card-lg">
                    <div class="h-1.5 w-full bg-brand-line"></div>
                    <div class="p-7 sm:p-8">
                        @yield('content')
                    </div>
                </div>

                <p class="mt-6 text-center text-xs text-ink-faint">
                    Besoin d'aide ?
                    <a href="{{ route('contact.form') }}" class="font-semibold text-primary-600 hover:text-primary-700">Contactez-nous</a>
                </p>
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
