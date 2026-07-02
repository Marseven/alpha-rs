@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Images du site</h4>
                        <span>Remplacer les images principales du site public</span>
                    </div>
                </div>
            </div>

            @include('layouts.flash-admin')
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin-site-images') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @foreach ($images as $key => $info)
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold">{{ $info['label'] }}</label>
                                            <div class="mb-2">
                                                @if ($info['value'])
                                                    <img src="{{ asset($info['value']) }}" alt="{{ $info['label'] }}"
                                                         style="max-height:120px;border-radius:8px" class="img-fluid">
                                                @else
                                                    <span class="text-muted">Aucune image (image par défaut utilisée).</span>
                                                @endif
                                            </div>
                                            <input type="file" name="{{ $key }}" accept=".jpg,.jpeg,.png,.webp"
                                                   class="form-control">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-primary">Enregistrer les images</button>
                                <p class="text-muted mt-2"><small>Formats : JPG, PNG, WEBP — 4 Mo max.</small></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
