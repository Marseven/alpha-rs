@extends('layouts.public')

@section('title', 'Simulateur de prise en charge')
@section('meta_description', "Simulez gratuitement votre prise en charge médicale à l'étranger : destination, service et pathologie pour une estimation immédiate.")

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="bg-gradient-to-b from-primary-50/60 to-white">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Simulateur de prise en charge</span>
                <h1 class="mt-3 font-display text-4xl font-extrabold leading-[1.12] tracking-tight text-ink sm:text-5xl">
                    Estimez votre prise en charge
                </h1>
                <p class="mx-auto mt-4 max-w-xl text-lg leading-relaxed text-ink-muted">
                    Choisissez votre destination, le service souhaité et la pathologie concernée.
                    Nous vous présentons une estimation indicative des montants pris en charge.
                </p>
            </div>

            {{-- ================= FORMULAIRE ================= --}}
            <div class="mx-auto mt-10 max-w-3xl">
                @if ($errors->any())
                    <x-ui.alert type="danger" class="mb-6">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </x-ui.alert>
                @endif

                <form method="POST" action="{{ route('simulate') }}">
                    @csrf
                    <x-ui.card padding="p-6 sm:p-8">
                        <div class="grid gap-5 sm:grid-cols-3">
                            <div>
                                <label for="country_id" class="mb-1.5 block text-sm font-semibold text-ink">
                                    Pays de destination <span class="text-accent-600">*</span>
                                </label>
                                <select name="country_id" id="country_id" required
                                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    <option value="" disabled {{ old('country_id') ? '' : 'selected' }}>Sélectionnez un pays</option>
                                    @foreach ($countries as $ct)
                                        <option value="{{ $ct->id }}" @selected(old('country_id') == $ct->id)>{{ $ct->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="service_id" class="mb-1.5 block text-sm font-semibold text-ink">
                                    Service <span class="text-accent-600">*</span>
                                </label>
                                <select name="service_id" id="service_id" required
                                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    <option value="" disabled {{ old('service_id') ? '' : 'selected' }}>Sélectionnez un service</option>
                                    @foreach ($services as $sv)
                                        <option value="{{ $sv->id }}" @selected(old('service_id') == $sv->id)>{{ $sv->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="sick_id" class="mb-1.5 block text-sm font-semibold text-ink">
                                    Pathologie <span class="text-accent-600">*</span>
                                </label>
                                <select name="sick_id" id="sick_id" required
                                        class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                    <option value="" disabled {{ old('sick_id') ? '' : 'selected' }}>Sélectionnez une pathologie</option>
                                    @foreach ($sicks as $sc)
                                        <option value="{{ $sc->id }}" @selected(old('sick_id') == $sc->id)>{{ $sc->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col items-center gap-3 border-t border-line pt-6 sm:flex-row sm:justify-between">
                            <p class="text-sm text-ink-muted">Estimation indicative, sans engagement.</p>
                            <x-ui.button type="submit" variant="accent" class="w-full sm:w-auto">
                                Lancer la simulation
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </x-ui.button>
                        </div>
                    </x-ui.card>
                </form>
            </div>
        </div>
    </section>

    {{-- ================= COMMENT ÇA MARCHE ================= --}}
    <section class="bg-canvas">
        <div class="mx-auto max-w-container px-4 py-16 lg:px-6 lg:py-20">
            <div class="mb-10 max-w-2xl">
                <span class="eyebrow">Comment ça marche</span>
                <h2 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-[38px]">Une estimation en trois étapes</h2>
                <p class="mt-3 text-ink-muted">
                    Le simulateur croise vos choix pour afficher les montants pris en charge correspondants.
                    Pour une évaluation détaillée, demandez un devis personnalisé.
                </p>
            </div>
            <div class="grid gap-6 sm:grid-cols-3">
                @foreach ([
                    ['01', 'Choisissez la destination', 'Le pays où la prise en charge médicale est envisagée.'],
                    ['02', 'Sélectionnez le service', 'Le niveau d\'accompagnement Relief Services adapté à votre besoin.'],
                    ['03', 'Précisez la pathologie', 'La nature des soins concernés pour affiner l\'estimation.'],
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

@endsection
