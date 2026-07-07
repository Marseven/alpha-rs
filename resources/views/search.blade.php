@extends('layouts.public')

@section('title', 'Recherche')

@section('content')
    {{-- ================= HERO / RECHERCHE ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="max-w-2xl">
                <span class="eyebrow">Destinations par maladie</span>
                <h1 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-4xl">
                    Résultats pour « {{ $keyword }} »
                </h1>
                <p class="mt-3 text-ink-muted">
                    Les villes et hôpitaux partenaires qui prennent en charge cette pathologie.
                    Affinez votre recherche par nom de maladie.
                </p>
            </div>

            <form method="POST" action="{{ route('search') }}" class="mt-6 max-w-xl">
                @csrf
                <div class="flex flex-col gap-3 sm:flex-row">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-ink-faint" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input type="text" name="q" id="sick" value="{{ $keyword }}" placeholder="Cancer, ..."
                               class="w-full rounded-lg border-[1.5px] border-line-strong py-2.5 pl-11 pr-3.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                    </div>
                    <x-ui.button type="submit" variant="primary">Rechercher</x-ui.button>
                </div>
            </form>
        </div>
    </section>

    {{-- ================= RÉSULTATS ================= --}}
    <section class="bg-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            @if ($towns->isNotEmpty())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($towns as $town)
                        <x-ui.card padding="p-0" class="group flex flex-col overflow-hidden">
                            <div class="aspect-[4/3] overflow-hidden bg-primary-100">
                                <img src="{{ $town->picture }}" alt="{{ $town->label }}" loading="lazy"
                                     class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="font-display text-lg font-bold text-ink">{{ $town->label }}</h3>
                                <p class="mt-1 inline-flex items-center gap-1.5 text-sm text-ink-muted">
                                    <svg class="h-4 w-4 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    {{ $town->country?->label }}
                                </p>
                                <div class="mt-4 pt-1">
                                    <x-ui.button variant="outline" href="{{ url('quote/town/' . $town->id) }}" class="w-full">Demander un devis</x-ui.button>
                                </div>
                            </div>
                        </x-ui.card>
                    @endforeach
                </div>
            @else
                <x-ui.card padding="p-8" class="text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-canvas text-ink-faint">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <h3 class="mt-4 font-display text-lg font-bold text-ink">Aucun résultat</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm text-ink-muted">
                        Aucune destination ne correspond à « {{ $keyword }} ». Essayez un autre nom de maladie
                        ou contactez-nous pour une prise en charge personnalisée.
                    </p>
                    <div class="mt-6">
                        <x-ui.button variant="primary" href="{{ route('contact.form') }}">Nous contacter</x-ui.button>
                    </div>
                </x-ui.card>
            @endif
        </div>
    </section>
@endsection
