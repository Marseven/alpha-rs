<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') — Relief Services</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/LogoRSA.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-canvas text-ink">

    @php
        $groups = [
            ['label' => null, 'items' => [
                ['url' => url('admin/dashboard'), 'match' => 'admin/dashboard', 'label' => 'Tableau de bord', 'icon' => 'M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z'],
            ]],
            ['label' => 'Activité', 'items' => [
                ['url' => url('admin/list-folders'), 'match' => 'admin/list-folders', 'label' => 'Dossiers', 'icon' => 'M4 4h6l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z'],
                ['url' => url('admin/list-quotes'), 'match' => 'admin/list-quotes', 'label' => 'Devis', 'icon' => 'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Zm0 0v6h6'],
                ['url' => url('admin/list-payments'), 'match' => 'admin/list-payments', 'label' => 'Paiements', 'icon' => 'M3 10h18M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z'],
            ]],
            ['label' => 'Catalogue', 'items' => [
                ['url' => url('admin/list-services'), 'match' => 'admin/list-services', 'label' => 'Services', 'icon' => 'M20.59 13.41 11 3.83V3H4v7h.83l9.59 9.59a2 2 0 0 0 2.83 0l3.34-3.34a2 2 0 0 0 0-2.83ZM7 7h.01'],
                ['url' => url('admin/list-sicks'), 'match' => 'admin/list-sicks', 'label' => 'Pathologies', 'icon' => 'M11 2v2M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1M8 15a6 6 0 0 0 12 0v-3'],
                ['url' => url('admin/list-hospitals'), 'match' => 'admin/list-hospitals', 'label' => 'Hôpitaux', 'icon' => 'M12 6v4m-2-2h4M4 21V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16M2 21h20M9 21v-4h6v4'],
                ['url' => url('admin/list-countries'), 'match' => 'admin/list-countries', 'label' => 'Pays & villes', 'icon' => 'M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20ZM2 12h20M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20Z'],
                ['url' => url('admin/list-simulators'), 'match' => 'admin/list-simulators', 'label' => 'Simulateur', 'icon' => 'M9 3v18m6-18v18M3 9h18M3 15h18'],
            ]],
            ['label' => 'Administration', 'items' => [
                ['url' => url('admin/list-users'), 'match' => 'admin/list-users', 'label' => 'Utilisateurs', 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm14 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75'],
                ['url' => url('admin/staff'), 'match' => 'admin/staff', 'label' => 'Personnel médical', 'icon' => 'M11 2v2M5 2v2M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1M8 15a6 6 0 0 0 12 0v-3'],
                ['url' => url('admin/assistant-knowledge'), 'match' => 'admin/assistant-knowledge', 'label' => 'Assistant IA', 'icon' => 'M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z'],
                ['url' => url('admin/security-role'), 'match' => 'admin/security-*', 'label' => 'Rôles & droits', 'icon' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z'],
                ['url' => url('admin/site-images'), 'match' => 'admin/site-images', 'label' => 'Réglages du site', 'icon' => 'M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7.4-3a7.4 7.4 0 0 0-.14-1.42l2.1-1.65-2-3.46-2.49 1a7.3 7.3 0 0 0-2.46-1.42L14 2h-4l-.41 2.63A7.3 7.3 0 0 0 7.13 6l-2.49-1-2 3.46 2.1 1.65a7.4 7.4 0 0 0 0 2.84l-2.1 1.65 2 3.46 2.49-1a7.3 7.3 0 0 0 2.46 1.42L10 22h4l.41-2.63a7.3 7.3 0 0 0 2.46-1.42l2.49 1 2-3.46-2.1-1.65c.09-.46.14-.94.14-1.42Z'],
            ]],
        ];
    @endphp

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col overflow-y-auto bg-primary-950 text-primary-100 lg:flex">
            <a href="{{ url('admin/dashboard') }}" class="flex items-center gap-3 border-b border-white/10 px-5 py-4">
                <img src="{{ asset('images/LogoRSA.png') }}" alt="Relief Services" class="h-9 w-auto">
                <div class="leading-tight">
                    <div class="font-display text-sm font-extrabold text-white">Relief Services</div>
                    <div class="font-mono text-[10px] uppercase tracking-[0.14em] text-primary-400">Back-office</div>
                </div>
            </a>

            <nav class="flex-1 space-y-5 px-3 py-5">
                @foreach ($groups as $group)
                    <div>
                        @if ($group['label'])
                            <div class="px-3 pb-2 font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-primary-400">{{ $group['label'] }}</div>
                        @endif
                        <div class="space-y-1">
                            @foreach ($group['items'] as $item)
                                @php $active = request()->is($item['match']); @endphp
                                <a href="{{ $item['url'] }}"
                                   class="relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition-colors {{ $active ? 'bg-white/[.12] text-white' : 'text-primary-200 hover:bg-white/[.06] hover:text-white' }}">
                                    @if ($active)<span class="absolute left-0 top-1/2 h-6 -translate-y-1/2 rounded-r bg-[#2E9BE8]" style="width:3px"></span>@endif
                                    <svg class="h-5 w-5 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $item['icon'] }}"/></svg>
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>

            <div class="border-t border-white/10 p-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-primary-200 transition-colors hover:bg-white/[.06] hover:text-white">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex min-h-screen flex-1 flex-col lg:pl-64">
            <header class="sticky top-0 z-30 flex items-center justify-between border-b border-line bg-white/95 px-4 py-3 backdrop-blur lg:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="document.getElementById('admin-sidebar').classList.toggle('hidden');document.getElementById('admin-sidebar').classList.toggle('flex')" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-line-strong text-ink lg:hidden" aria-label="Menu">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="font-display text-lg font-bold text-ink">@yield('page_title', 'Administration')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="hidden text-sm font-semibold text-ink-muted hover:text-primary-600 sm:block">Voir le site →</a>
                    <div class="relative" id="admin-user-dropdown">
                        <button type="button" onclick="document.getElementById('admin-user-menu').classList.toggle('hidden')"
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-600 font-display text-sm font-bold text-white ring-2 ring-transparent transition hover:ring-primary-200" aria-label="Menu du compte">
                            {{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </button>
                        <div id="admin-user-menu" class="absolute right-0 z-40 mt-2 hidden w-60 overflow-hidden rounded-2xl border border-line bg-white py-1.5 shadow-card-lg">
                            <div class="border-b border-line px-4 py-3">
                                <div class="truncate text-sm font-bold text-ink">{{ auth()->user()->name }}</div>
                                <div class="truncate text-xs text-ink-muted">{{ auth()->user()->email }}</div>
                            </div>
                            <a href="{{ route('admin-profil') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-semibold text-ink hover:bg-canvas">
                                <svg class="h-4 w-4 text-ink-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/></svg>
                                Mon profil
                            </a>
                            <a href="{{ route('admin-site-images') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-semibold text-ink hover:bg-canvas">
                                <svg class="h-4 w-4 text-ink-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3M1 14h6M9 8h6M17 16h6"/></svg>
                                Réglages de la plateforme
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-line">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2.5 px-4 py-2.5 text-sm font-semibold text-accent-600 hover:bg-accent-50">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            @include('layouts.flash')

            <main class="flex-1 px-4 py-6 lg:px-8 lg:py-8">
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>

    <x-chatbot />

    <script>
        document.addEventListener('click', function (e) {
            const dd = document.getElementById('admin-user-dropdown');
            const menu = document.getElementById('admin-user-menu');
            if (dd && menu && ! dd.contains(e.target)) menu.classList.add('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
