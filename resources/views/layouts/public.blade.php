<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Relief Services') — Relief Services</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/LogoRSA.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-ink">

    {{-- Topbar --}}
    <div class="bg-primary-900 text-primary-100">
        <div class="mx-auto flex max-w-container items-center justify-between px-4 py-2 text-[13px] font-medium lg:px-6">
            <div class="flex flex-wrap items-center gap-x-6 gap-y-1">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    Libreville · Port-Gentil, Gabon
                </span>
                <span class="hidden items-center gap-1.5 sm:inline-flex">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                    (+241) 76 55 57 81
                </span>
                <span class="hidden items-center gap-1.5 md:inline-flex">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg>
                    info@reliefservices.net
                </span>
            </div>
            <div class="flex items-center gap-5">
                <a href="{{ route('faq') }}" class="hover:text-white">FAQ</a>
                <a href="{{ route('track.form') }}" class="hover:text-white">Suivre mon dossier</a>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <header class="sticky top-0 z-40 border-b border-line bg-white/95 backdrop-blur">
        <nav class="mx-auto flex max-w-container items-center justify-between px-4 py-3 lg:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/LogoRSA.png') }}" alt="Relief Services" class="h-11 w-auto">
                <span class="font-display text-lg font-extrabold text-ink">Relief Services</span>
            </a>

            <div class="hidden items-center gap-7 text-[15px] font-semibold text-ink lg:flex">
                <a href="{{ route('home') }}" class="text-primary-600">Accueil</a>
                <a href="{{ route('home') }}#services" class="hover:text-primary-600">Nos services</a>
                <a href="{{ route('simulator') }}" class="hover:text-primary-600">Simulateur</a>
                <a href="{{ route('list-hospitals') }}" class="hover:text-primary-600">Hôpitaux</a>
                <a href="{{ route('contact.form') }}" class="hover:text-primary-600">Contact</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <x-ui.button variant="outline" href="{{ route('profil') }}" class="hidden sm:inline-flex">Mon espace</x-ui.button>
                @else
                    <x-ui.button variant="outline" href="{{ route('login') }}" class="hidden sm:inline-flex">Espace client</x-ui.button>
                @endauth
                <x-ui.button variant="accent" href="{{ route('quote') }}">Demander un devis</x-ui.button>

                {{-- Mobile menu toggle --}}
                <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-line-strong text-ink lg:hidden" aria-label="Menu">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>

        {{-- Mobile menu panel --}}
        <div id="mobile-menu" class="hidden border-t border-line bg-white lg:hidden">
            <div class="mx-auto flex max-w-container flex-col px-4 py-2 text-[15px] font-semibold text-ink">
                <a href="{{ route('home') }}" class="py-2.5">Accueil</a>
                <a href="{{ route('home') }}#services" class="py-2.5">Nos services</a>
                <a href="{{ route('simulator') }}" class="py-2.5">Simulateur</a>
                <a href="{{ route('list-hospitals') }}" class="py-2.5">Hôpitaux</a>
                <a href="{{ route('contact.form') }}" class="py-2.5">Contact</a>
                <a href="{{ auth()->check() ? route('profil') : route('login') }}" class="py-2.5 text-primary-600">{{ auth()->check() ? 'Mon espace' : 'Espace client' }}</a>
            </div>
        </div>
    </header>

    @include('layouts.flash')

    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    <footer id="contact" class="bg-primary-950 text-primary-100">
        <div class="brand-line"></div>
        <div class="mx-auto grid max-w-container gap-10 px-4 py-14 lg:grid-cols-4 lg:px-6">
            <div class="lg:col-span-1">
                <div class="mb-4 flex items-center gap-3">
                    <img src="{{ asset('images/LogoRSA.png') }}" alt="Relief Services" class="h-10 w-auto">
                    <span class="font-display text-lg font-extrabold text-white">Relief Services</span>
                </div>
                <p class="text-sm leading-relaxed text-primary-200">Assistance médicale et évacuation sanitaire depuis le Gabon : du devis jusqu'au retour, en toute confiance.</p>
            </div>

            <div>
                <div class="eyebrow mb-4 text-primary-300">Navigation</div>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Accueil</a></li>
                    <li><a href="{{ route('simulator') }}" class="hover:text-white">Simulateur</a></li>
                    <li><a href="{{ route('list-hospitals') }}" class="hover:text-white">Hôpitaux partenaires</a></li>
                    <li><a href="{{ route('quote') }}" class="hover:text-white">Demander un devis</a></li>
                    <li><a href="{{ route('track.form') }}" class="hover:text-white">Suivre mon dossier</a></li>
                </ul>
            </div>

            <div>
                <div class="eyebrow mb-4 text-primary-300">Contact</div>
                <ul class="space-y-2.5 text-sm text-primary-200">
                    <li>Libreville · Port-Gentil, Gabon</li>
                    <li>(+241) 76 55 57 81</li>
                    <li>info@reliefservices.net</li>
                    <li><a href="{{ route('assistant.form') }}" class="hover:text-white">Assistant en ligne</a></li>
                </ul>
            </div>

            <div>
                <div class="eyebrow mb-4 text-primary-300">Informations</div>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>
                    <li><a href="{{ route('cgu') }}" class="hover:text-white">Conditions générales</a></li>
                    <li><a href="{{ route('pc') }}" class="hover:text-white">Politique de confidentialité</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="mx-auto max-w-container px-4 py-5 text-center text-xs text-primary-300 lg:px-6">
                © {{ date('Y') }} Relief Services. Tous droits réservés.
            </div>
        </div>
    </footer>

    <x-chatbot />

    @stack('scripts')
</body>
</html>
