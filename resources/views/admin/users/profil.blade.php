@extends('layouts.backoffice')

@section('title', 'Profil')
@section('page_title', 'Profil')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div>
            <span class="eyebrow">Espace administration</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Mon profil</h2>
            <p class="mt-1 text-sm text-ink-muted">Gérez vos informations personnelles et votre mot de passe.</p>
        </div>

        {{-- En-tête profil --}}
        <x-ui.card>
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-center">
                <img src="{{ asset($user->picture ? $user->picture : '/images/blank.png') }}"
                    class="h-20 w-20 flex-none rounded-full border border-line object-cover" alt="{{ $user->name }}">
                <div class="text-center sm:text-left">
                    <h3 class="font-display text-xl font-extrabold text-ink">{{ $user->name }}</h3>
                    <p class="mt-0.5 text-sm font-semibold text-primary-600">{{ $user->role ? $user->role?->name : 'Aucun' }}</p>
                    <p class="mt-1 text-sm text-ink-muted">{{ $user->email }}</p>
                </div>
            </div>
        </x-ui.card>

        <div class="grid gap-6 lg:grid-cols-3">
            {{-- Statistiques --}}
            <div class="lg:col-span-1">
                <x-ui.card>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div>
                            <div class="font-display text-2xl font-extrabold text-ink">150</div>
                            <div class="mt-1 text-xs text-ink-muted">Devis</div>
                        </div>
                        <div>
                            <div class="font-display text-2xl font-extrabold text-ink">140</div>
                            <div class="mt-1 text-xs text-ink-muted">Dossiers</div>
                        </div>
                        <div>
                            <div class="font-display text-2xl font-extrabold text-ink">45</div>
                            <div class="mt-1 text-xs text-ink-muted">Reviews</div>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            {{-- Réglages --}}
            <div class="lg:col-span-2">
                <x-ui.card>
                    <div class="mb-5 flex gap-2 border-b border-line pb-4">
                        <button type="button" id="tab-btn-infos"
                            class="rounded-lg bg-primary-50 px-4 py-2 text-sm font-semibold text-primary-700"
                            onclick="document.getElementById('tab-infos').classList.remove('hidden');document.getElementById('tab-password').classList.add('hidden');this.classList.add('bg-primary-50','text-primary-700');this.classList.remove('text-ink-muted');document.getElementById('tab-btn-password').classList.remove('bg-primary-50','text-primary-700');document.getElementById('tab-btn-password').classList.add('text-ink-muted')">Informations personnelles</button>
                        <button type="button" id="tab-btn-password"
                            class="rounded-lg px-4 py-2 text-sm font-semibold text-ink-muted"
                            onclick="document.getElementById('tab-password').classList.remove('hidden');document.getElementById('tab-infos').classList.add('hidden');this.classList.add('bg-primary-50','text-primary-700');this.classList.remove('text-ink-muted');document.getElementById('tab-btn-infos').classList.remove('bg-primary-50','text-primary-700');document.getElementById('tab-btn-infos').classList.add('text-ink-muted')">Mot de passe</button>
                    </div>

                    {{-- Informations personnelles --}}
                    <div id="tab-infos">
                        <form method="POST" accept="" enctype="multipart/form-data" class="grid gap-4 sm:grid-cols-2">
                            @csrf
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Image de profil</label>
                                <input type="file" value="" placeholder="074010203" name="picture"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink file:mr-3 file:rounded-md file:border-0 file:bg-canvas file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Nom complet</label>
                                <input type="text" value="{{ $user->name }}" placeholder="Nom Complet" name="name"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Email</label>
                                <input type="email" value="{{ $user->email }}" name="email" placeholder="Email"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Téléphone</label>
                                <input type="text" value="{{ $user->phone }}" placeholder="074010203" name="phone"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            </div>
                            <div class="sm:col-span-2">
                                <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                            </div>
                        </form>
                    </div>

                    {{-- Mot de passe --}}
                    <div id="tab-password" class="hidden">
                        <form method="POST" accept="" enctype="multipart/form-data" class="grid gap-4">
                            @csrf
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Mot de passe actuel</label>
                                <input type="password" value="" placeholder="Mot de passe actuel"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15" />
                                <a href="#" class="mt-1.5 inline-block text-sm font-semibold text-primary-600 hover:text-primary-700">Mot de passe oublié ?</a>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Nouveau mot de passe</label>
                                <input type="password" value="" placeholder="Nouveau mot de passe"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-ink">Confirmer le mot de passe</label>
                                <input type="password" value="" placeholder="Confirmer mot de passe"
                                    class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15" />
                            </div>
                            <div>
                                <x-ui.button type="submit" variant="primary">Enregistrer</x-ui.button>
                            </div>
                        </form>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>
@endsection
