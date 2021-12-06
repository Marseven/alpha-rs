@extends('layouts.default')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/roboto-font.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('css/style-wizard.css') }}" />
@endpush

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
                                <p>Simulateur</p>
                            </li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====================
                                                                                                                                                                                                                                                                                                                                                                                                                                                Breadcrum Part HTML End
                                                                                                                                                                                                                                                                                                                                                                                                                                            ======================-->

    @include('layouts.flash')

    <!-- =============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                Start: About Us
                                                                                                                                                                                                                                                                                                                                                                                                                                            ============================= -->

    <section class="aboutus aboutpage section" style="padding-top: 0px;">
        <div class="container">
            <div class="row about-page-para">

                <div class="container">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="heading b-text text-center">
                                <h5>Obtenez des estimations</h5>
                                <h2>Faites une simulation</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-v3-content col-lg-12">
                    <div class="wizard-form">
                        <div class="wizard-header">
                            <h3 class="heading">Le Simulateur ALPHA</h3>
                            <p>Les estimations sont pour une seule personne et sur un seul mois</p>
                        </div>
                        <form class="form-register" action="{{ route('simulate') }}" method="post">
                            <div id="form-total">
                                <!-- SECTION 1 -->
                                <h2>
                                    <span class="step-icon"><i class="fa fa-plus"></i></span>
                                    <span class="step-text">La Spécialité</span>
                                </h2>
                                <section>
                                    <div class="inner">
                                        <h3>Quel pathologie souhaité vous soigné ?</h3>
                                        <div class="form-row">
                                            <div class="form-holder form-holder-2">
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <select name="country_id" class="form-control">
                                                            @foreach ($sicks as $sick)
                                                                <option value="{{ $sick->id }}">{{ $sick->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- SECTION 2 -->
                                <h2>
                                    <span class="step-icon"><i class="fa fa-map-marker"></i></span>
                                    <span class="step-text">Le Pays</span>
                                </h2>
                                <section>
                                    <div class="inner">
                                        <h3>Dans quel pays souhaitez-vous aller vous soignez ?</h3>

                                        <div class="form-row">
                                            <div class="form-holder form-holder-2">
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <select name="country_id" class="form-control">
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">
                                                                    {{ $country->label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- SECTION 3 -->
                                <h2>
                                    <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                                    <span class="step-text">Le Service</span>
                                </h2>
                                <section>
                                    <div class="inner">
                                        <h3>Vous souhaitez souscrire à quel service ?</h3>
                                        <div class="form-row">
                                            <div class="form-holder form-holder-2">
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <select name="service_id" id="service_id"
                                                            class="form-control service_id">
                                                            @foreach ($services as $service)
                                                                <option value="{{ $service->id }}">
                                                                    {{ $service->label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-10" id="service1" style="display: none">
                                                        <br>
                                                        <br>
                                                        <label> <strong>Éléments du Service</strong></label>
                                                        <br>
                                                        <ol>
                                                            <li></li>
                                                        </ol>
                                                    </div>
                                                    <div class="col-sm-10" id="service2" style="display: none">
                                                        <br>
                                                        <br>
                                                        <label> <strong>Éléments du Service</strong></label>
                                                        <br>
                                                        <ol>
                                                            <li>Hébergement</li>
                                                            <li>Transport Standard</li>
                                                            <li>Restauration</li>
                                                        </ol>
                                                    </div>
                                                    <div class="col-sm-10" id="service3" style="display: none">
                                                        <br>
                                                        <br>
                                                        <label> <strong>Éléments du Service</strong></label>
                                                        <br>
                                                        <ol>
                                                            <li>Hébergement</li>
                                                            <li>Transport Standard ou Médicalisé</li>
                                                            <li>Restauration</li>
                                                            <li>Accompagnement</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">

                        <div class="col-12 ">
                            <div class="heading b-text text-center">
                                <h5>Quel maladie souhatez-vous soignée ?</h5>
                                <h2>Trouver une Destination</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- =============================
                                                                                                                                                                                                                                                                                                Start: Search
                                                                                                                                                                                                                                                                                            ============================= -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-inline" method="POST" action="{{ route('search') }}">
                                @csrf
                                <div class="col-sm-1">
                                </div>
                                <div class="form-group col-sm-8">
                                    <input type="text" style="width: 100%" name="q" class="form-control form-control-lg"
                                        id="sick" placeholder="Cancer, ...">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Recherche</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                End: About Us
                                                                                                                                                                                                                                                                                                                                                                                                                                            ============================= -->

@endsection

@push('scripts')

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script language="JavaScript">
        $(function() {

            $('#service_id').change(function() {
                var service1 = document.getElementById("service1");
                var service2 = document.getElementById("service2");
                var service3 = document.getElementById("service3");

                var valeur = document.getElementById("service_id").value;

                if (valeur == 1) {
                    service1.style.display = "block";
                    service2.style.display = "none";
                    service3.style.display = "none";
                }

                if (valeur == 2) {
                    service1.style.display = "none";
                    service2.style.display = "block";
                    service3.style.display = "none";
                }

                if (valeur == 3) {
                    service1.style.display = "none";
                    service2.style.display = "none";
                    service3.style.display = "block";
                }
            });
        });
    </script>
@endpush
