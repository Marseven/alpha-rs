@extends('layouts.public')

@section('title', 'Demander un devis')

@section('content')
    <section class="bg-canvas">
        <div class="mx-auto max-w-3xl px-4 py-16 lg:px-6 lg:py-20">
            <span class="eyebrow">Demande de devis</span>
            <h1 class="mt-3 font-display text-3xl font-extrabold text-ink sm:text-4xl">Vous souhaitez vous soigner à l'étranger&nbsp;?</h1>
            <p class="mt-3 text-ink-muted">Renseignez les informations du patient, précisez votre demande et joignez le dossier médical. Notre équipe revient vers vous sous 72&nbsp;heures maximum.</p>

            @if (session('success'))
                <x-ui.alert type="success" class="mt-6">{{ session('success') }}</x-ui.alert>
            @endif
            @if (session('error'))
                <x-ui.alert type="danger" class="mt-6">{{ session('error') }}</x-ui.alert>
            @endif
            @if ($errors->any())
                <x-ui.alert type="danger" class="mt-6">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </x-ui.alert>
            @endif

            <form method="POST" action="{{ route('quote') }}" enctype="multipart/form-data" class="mt-8 space-y-6">
                @csrf

                {{-- ============ Informations patient ============ --}}
                <x-ui.card padding="p-6 sm:p-8">
                    <h2 class="font-display text-lg font-bold text-ink">Informations patient</h2>
                    <p class="mt-1 text-sm text-ink-muted">Identité de la personne à prendre en charge.</p>

                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="lastname" class="mb-1.5 block text-sm font-semibold text-ink">Nom <span class="text-accent-600">*</span></label>
                            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Nom" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('lastname')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="firstname" class="mb-1.5 block text-sm font-semibold text-ink">Prénom</label>
                            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Prénom"
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('firstname')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="birthday" class="mb-1.5 block text-sm font-semibold text-ink">Date de naissance <span class="text-accent-600">*</span></label>
                            <input type="date" id="birthday" name="birthday" value="{{ old('birthday') }}" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('birthday')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="gender" class="mb-1.5 block text-sm font-semibold text-ink">Genre <span class="text-accent-600">*</span></label>
                            <select id="gender" name="gender" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                <option value="M" @selected(old('gender', 'M') === 'M')>Masculin</option>
                                <option value="F" @selected(old('gender') === 'F')>Féminin</option>
                            </select>
                            @error('gender')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-semibold text-ink">Email <span class="text-accent-600">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nom.prenom@domaine.com" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('email')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-semibold text-ink">Téléphone <span class="text-accent-600">*</span></label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="074010203" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error('phone')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </x-ui.card>

                {{-- ============ Détails de la demande ============ --}}
                <x-ui.card padding="p-6 sm:p-8">
                    <h2 class="font-display text-lg font-bold text-ink">Détails de la demande</h2>
                    <p class="mt-1 text-sm text-ink-muted">Type de demandeur, destination et service sollicité.</p>

                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="category" class="mb-1.5 block text-sm font-semibold text-ink">Catégorie <span class="text-accent-600">*</span></label>
                            <select id="category" name="category" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                <option @selected(!old('category'))>Choisir...</option>
                                <option @selected(old('category') === 'Particulier')>Particulier</option>
                                <option @selected(old('category') === 'Entreprise')>Entreprise</option>
                                <option @selected(old('category') === 'Assurance')>Assurance</option>
                                <option @selected(old('category') === 'Établissement Sanitaire')>Établissement Sanitaire</option>
                                <option @selected(old('category') === 'Autre')>Autre</option>
                            </select>
                            @error('category')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="country_id" class="mb-1.5 block text-sm font-semibold text-ink">Pays de destination <span class="text-accent-600">*</span></label>
                            <select id="country_id" name="country_id" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @if ($country_check)
                                    <option value="{{ $country_check->id }}">{{ $country_check->label }}</option>
                                @endif
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->label }}</option>
                                @endforeach
                            </select>
                            @error('country_id')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="service_id" class="mb-1.5 block text-sm font-semibold text-ink">Service sollicité <span class="text-accent-600">*</span></label>
                            <select id="service_id" name="service_id" required
                                    class="w-full rounded-lg border-[1.5px] border-line-strong bg-white px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                                @if ($service_check)
                                    <option value="{{ $service_check->id }}">{{ $service_check->label }}</option>
                                @endif
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->label }}</option>
                                @endforeach
                            </select>
                            @error('service_id')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </x-ui.card>

                {{-- ============ Pièces justificatives ============ --}}
                <x-ui.card padding="p-6 sm:p-8">
                    <h2 class="font-display text-lg font-bold text-ink">Pièces justificatives</h2>
                    <p class="mt-1 text-sm text-ink-muted">Formats acceptés : PDF, JPG ou PNG (10&nbsp;Mo max par fichier).</p>

                    <div class="mt-6 space-y-5">
                        <div>
                            <label for="join_piece_passport" class="mb-1.5 block text-sm font-semibold text-ink">Copie de votre passeport <span class="text-accent-600">*</span></label>
                            <input type="file" id="join_piece_passport" name="join_piece_passport" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15 file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 hover:file:bg-primary-100">
                            @error('join_piece_passport')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="join_piece_rapport" class="mb-1.5 block text-sm font-semibold text-ink">Rapport médical de votre médecin traitant <span class="text-accent-600">*</span></label>
                            <input type="file" id="join_piece_rapport" name="join_piece_rapport" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15 file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 hover:file:bg-primary-100">
                            @error('join_piece_rapport')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="join_piece_examen" class="mb-1.5 block text-sm font-semibold text-ink">Examens effectués (IRM, scanner, radiographie, biopsies…) <span class="text-accent-600">*</span></label>
                            <input type="file" id="join_piece_examen" name="join_piece_examen" required
                                   class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15 file:mr-3 file:rounded-md file:border-0 file:bg-primary-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-primary-700 hover:file:bg-primary-100">
                            @error('join_piece_examen')<p class="mt-1.5 text-sm text-accent-700">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <x-ui.alert type="info" class="mt-6">
                        <ul class="list-inside list-disc space-y-1">
                            <li>Assurez-vous que tous les documents demandés ont bien été téléversés.</li>
                            <li>La procédure prendra plus de temps si le dossier médical est incomplet.</li>
                            <li>Vous pouvez nous contacter sous 48&nbsp;h pour compléter le dossier.</li>
                            <li>En cas de désistement, les frais de dossier ne sont pas remboursables.</li>
                        </ul>
                    </x-ui.alert>
                </x-ui.card>

                {{-- ============ Consentement + envoi ============ --}}
                <div>
                    <label for="gridCheck" class="flex items-start gap-3 text-sm text-ink">
                        <input type="checkbox" id="gridCheck" required
                               class="mt-0.5 h-5 w-5 rounded border-[1.5px] border-line-strong text-primary-600 focus:ring-2 focus:ring-primary-600/15">
                        <span>J'accepte <a target="_blank" href="{{ route('cgu') }}" class="font-semibold text-primary-600 hover:text-primary-700">les termes et conditions d'utilisation</a>.</span>
                    </label>

                    <div class="mt-6">
                        <x-ui.button type="submit" variant="accent" class="w-full sm:w-auto">Demander un devis</x-ui.button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
