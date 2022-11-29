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
                        <h1 class="heading-font">Paiement</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>
                                <p>Paiement</p>
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
                        <h2>Payer Les Frais de Service Relief Services</h2>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="container">
                    <div class="row text-center">
                        <div class="col-12">
                            <h3 class="mb-1">Frais de Service : {{ $service_id->label }}</h3>
                            <h1>{{ number_format($service_id->price, 0, ',', ' ') }} XAF</h1>
                        </div>
                    </div>
                    <br><br>
                </div>
                <hr>
                <div class="container">

                </div>
            </div>
            <br><br>
            <div class="text-center">
                <a class="btn btn-4 btn-ser" href="{{ url('quote/pay/' . $quote->id) }}">Payer</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
