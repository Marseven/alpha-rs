@extends('layouts.default')

@section('content')
    <!--=========================
                                                                                                                            Breadcrum Part HTML Start
                                                                                                                            =======================-->
    <section id="breadcrun" class="breadcrun-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="bread-inner">
                        <h1 class="heading-font">SIMULATEUR</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>
                                <p>Résultats</p>
                            </li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="service" class="service section">
        <div class="container">

            <div class="row">

                <div class="col-12 ">
                    <div class="heading b-text text-center">
                        <h2>Résultat de la Simulation</h2>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="container">
                    <div class="row text-center">
                        <div class="col-6">
                            <h3 class="mb-1">{{ $country_id->label }}</h3><span>Destination</span>
                        </div>
                        <div class="col-6">
                            <h3 class="mb-1">{{ $service_id->label }}</h3>
                            <span>{{ number_format($service_id->price, 0, ',', ' ') }} XAF</span>
                        </div>
                    </div>
                    <br><br>
                </div>
                <hr>
                <div class="container">
                    <table class="table">
                        <thead>
                            <th>Libellé</th>
                            <th>Valeur</th>

                        </thead>
                        <tbody>

                            @foreach ($simulators as $simulator)
                                @php
                                    $simulator->load(['item']);
                                @endphp
                                <tr>
                                    <td><strong>{{ $simulator->item->label }}</strong></td>
                                    <td>{{ $simulator->value }}
                                        <span>{{ $simulator->note }}</span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="text-center">
                <a class="btn btn-4 btn-ser" href="{{ url('quote') }}">Demander un devis pour avoir plus d'informations</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
