@extends('layouts.backoffice')

@section('title', 'Images du site')
@section('page_title', 'Images du site')

@section('content')
    <div class="mx-auto max-w-[1400px] space-y-6">

        <div>
            <span class="eyebrow">Réglages du site</span>
            <h2 class="mt-2 font-display text-2xl font-extrabold text-ink">Images du site</h2>
            <p class="mt-1 text-sm text-ink-muted">Remplacer les images principales du site public.</p>
        </div>

        <x-ui.card>
            <form method="POST" action="{{ route('admin-site-images') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    @foreach ($images as $key => $info)
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-ink">{{ $info['label'] }}</label>
                            <div class="mb-3">
                                @if ($info['value'])
                                    <img src="{{ asset($info['value']) }}" alt="{{ $info['label'] }}"
                                        class="max-h-[120px] rounded-lg border border-line object-contain">
                                @else
                                    <span class="text-sm text-ink-muted">Aucune image (image par défaut utilisée).</span>
                                @endif
                            </div>
                            <input type="file" name="{{ $key }}" accept=".jpg,.jpeg,.png,.webp"
                                class="w-full rounded-lg border-[1.5px] border-line-strong px-3.5 py-2.5 text-[15px] text-ink file:mr-3 file:rounded-md file:border-0 file:bg-canvas file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15">
                            @error($key)<p class="mt-1 text-xs text-accent-600">{{ $message }}</p>@enderror
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex flex-wrap items-center gap-4">
                    <x-ui.button type="submit" variant="primary">Enregistrer les images</x-ui.button>
                    <p class="text-sm text-ink-muted">Formats : JPG, PNG, WEBP — 4 Mo max.</p>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
