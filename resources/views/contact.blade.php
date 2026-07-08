@extends('layouts.public')

@section('title', 'Contact')
@section('meta_description', "Contactez Relief Services pour votre assistance médicale et évacuation sanitaire — Libreville et Port-Gentil, Gabon.")

@section('content')
    {{-- ================= EN-TÊTE ================= --}}
    <section class="border-b border-line bg-gradient-to-b from-primary-50/60 to-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <span class="eyebrow">Nous joindre</span>
            <h1 class="mt-3 font-display text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">
                Contactez Relief Services
            </h1>
            <p class="mt-4 max-w-2xl text-lg leading-relaxed text-ink-muted">
                Une question sur votre prise en charge, un devis ou le suivi de votre dossier ? Écrivez-nous, notre
                équipe vous répond au plus tôt.
            </p>
        </div>
    </section>

    {{-- ================= CONTENU ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto grid max-w-container gap-10 px-4 py-16 lg:grid-cols-[1fr_1.4fr] lg:px-6 lg:py-20">

            {{-- Coordonnées --}}
            <div>
                <h2 class="font-display text-2xl font-bold text-ink">Nos coordonnées</h2>
                <p class="mt-2 text-[15px] leading-relaxed text-ink-muted">
                    Assistance médicale et évacuation sanitaire depuis le Gabon.
                </p>

                <ul class="mt-6 space-y-5">
                    <li class="flex items-start gap-4">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-line bg-white text-primary-600 shadow-card">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <div>
                            <div class="text-sm font-semibold text-ink">Adresse</div>
                            <div class="text-[15px] text-ink-muted">Libreville · Port-Gentil, Gabon</div>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-line bg-white text-primary-600 shadow-card">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                        </span>
                        <div>
                            <div class="text-sm font-semibold text-ink">Téléphone</div>
                            <div class="text-[15px] text-ink-muted">(+241) 76 55 57 81</div>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-line bg-white text-primary-600 shadow-card">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg>
                        </span>
                        <div>
                            <div class="text-sm font-semibold text-ink">E-mail</div>
                            <div class="text-[15px] text-ink-muted">info@reliefservices.net</div>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Formulaire --}}
            <div>
                @if (session('success'))
                    <x-ui.alert type="success" class="mb-6">{{ session('success') }}</x-ui.alert>
                @endif
                @if (session('error'))
                    <x-ui.alert type="danger" class="mb-6">{{ session('error') }}</x-ui.alert>
                @endif
                @if ($errors->any())
                    <x-ui.alert type="danger" class="mb-6">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </x-ui.alert>
                @endif

                <form method="POST" action="{{ route('contact') }}">
                    @csrf
                    <x-ui.card padding="p-6">
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="mb-1.5 block text-sm font-semibold text-ink">
                                    Nom complet <span class="text-accent-600">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('name')<p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="email" class="mb-1.5 block text-sm font-semibold text-ink">
                                        E-mail <span class="text-accent-600">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                           class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @error('email')<p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                           class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    @error('phone')<p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="mb-1.5 block text-sm font-semibold text-ink">
                                    Sujet <span class="text-accent-600">*</span>
                                </label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                                       class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @error('subject')<p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="message" class="mb-1.5 block text-sm font-semibold text-ink">
                                    Message <span class="text-accent-600">*</span>
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                          class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">{{ old('message') }}</textarea>
                                @error('message')<p class="mt-1.5 text-sm text-accent-600">{{ $message }}</p>@enderror
                            </div>

                            <x-ui.button type="submit" variant="accent" class="w-full">Envoyer le message</x-ui.button>
                        </div>
                    </x-ui.card>
                </form>
            </div>
        </div>
    </section>
@endsection
