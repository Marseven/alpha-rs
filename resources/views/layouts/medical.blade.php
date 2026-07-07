<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace médical') — Relief Services</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/LogoRSA.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-canvas text-ink">

    @php
        $role = auth()->check() ? auth()->user()->workflow_role : null;
        $isCnamgs = $role === 'cnamgs';
        $spaceName = $isCnamgs ? 'Espace CNAMGS' : 'Espace médecin';
        $casesRoute = $isCnamgs ? 'cnamgs.cases' : 'doctor.cases';
        $casesLabel = $isCnamgs ? 'Dossiers reçus' : 'Mes dossiers';
        $navItems = [
            ['route' => $casesRoute, 'label' => $casesLabel, 'icon' => 'M9 12h6m-6 4h6M9 8h6M5 4h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z'],
            ['route' => 'medical.profile', 'label' => 'Mon profil', 'icon' => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z'],
        ];
    @endphp

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside id="medical-sidebar" class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col bg-primary-900 text-primary-100 lg:flex">
            <a href="{{ Route::has($casesRoute) ? route($casesRoute) : '#' }}" class="flex items-center gap-3 border-b border-white/10 px-5 py-4">
                <img src="{{ asset('images/LogoRSA.png') }}" alt="Relief Services" class="h-9 w-auto">
                <div class="leading-tight">
                    <div class="font-display text-sm font-extrabold text-white">Relief Services</div>
                    <div class="font-mono text-[10px] uppercase tracking-[0.14em] text-primary-400">{{ $spaceName }}</div>
                </div>
            </a>

            <nav class="flex-1 space-y-1 px-3 py-5">
                @foreach ($navItems as $item)
                    @php $active = Route::has($item['route']) && request()->routeIs($item['route']); @endphp
                    <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                       class="relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition-colors {{ $active ? 'bg-white/[.12] text-white' : 'text-primary-200 hover:bg-white/[.06] hover:text-white' }}">
                        @if ($active)<span class="absolute left-0 top-1/2 h-6 -translate-y-1/2 rounded-r bg-[#2E9BE8]" style="width:3px"></span>@endif
                        <svg class="h-5 w-5 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $item['icon'] }}"/></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="border-t border-white/10 p-3">
                <div class="flex items-center gap-3 rounded-lg px-3 py-2">
                    <div class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-white/15 font-display text-sm font-bold text-white">
                        {{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="truncate text-sm font-semibold text-white">{{ auth()->user()->name ?? '' }}</div>
                        <div class="truncate text-xs text-primary-300">{{ $isCnamgs ? 'CNAMGS' : 'Médecin' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
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
                    <button type="button" onclick="document.getElementById('medical-sidebar').classList.toggle('hidden');document.getElementById('medical-sidebar').classList.toggle('flex')" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-line-strong text-ink lg:hidden" aria-label="Menu">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="font-display text-lg font-bold text-ink">@yield('page_title', $spaceName)</h1>
                </div>
                <span class="hidden rounded-full border border-line bg-canvas px-3 py-1 text-xs font-semibold text-ink-muted sm:inline-flex">{{ $spaceName }}</span>
            </header>

            @include('layouts.flash')

            <main class="flex-1 px-4 py-6 lg:px-8 lg:py-8">
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>

    <x-chatbot />

    @stack('scripts')
</body>
</html>
