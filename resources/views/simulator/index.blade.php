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
    <section id="aboutus" class="aboutus aboutpage section" style="padding-top: 0px;">
        <div class="container">
            <div class="row about-page-para">
                <div class="col-lg-5 col-md-5 text-left">
                    <div class="">
                        <img class="img-fluid about-page2" src="{{ asset('images/simu-image.png') }}" alt="about">
                    </div>

                </div>
                <div class="col-lg-7 col-md-7 text-left">
                    <div class="about-page-in">
                        <div class="heading b-text">
                            <h5>Obtenez des estimations</h5>
                            <h2>Faites une simulation</h2>
                        </div>

                        <br>
                        <br>
                        <div class="container">
                            <div class="row">

                                <div class="col-12 ">
                                    <div class="heading b-text text-center">
                                        <h5>Les maladies traitées</h5>
                                        <h2>Les Spécialités</h2>
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
                                    @foreach ($sicks as $sick)
                                        <h2 style="display: inline-block; margin : 3px;"><span
                                                class="badge badge-pill badge-primary">{{ $sick->label }}</span></h2>
                                    @endforeach

                                    @if ($sicks->count() == 0)
                                        <h2><span class="badge badge-pill badge-info">Aucune Maladie Pour le Moment</span>
                                        </h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- =============================
                                                                    End: Search
                                                                ============================= -->

                        <br>

                        <form method="POST" action="{{ route('simulate') }}" class="form_simu">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-12 col-form-label"></label>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Pays</label>
                                <div class="col-sm-10">
                                    <select name="country_id" class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Service</label>
                                <div class="col-sm-10">
                                    <select name="service_id" id="service_id" class="form-control service_id">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-10" id="service1" style="display: none">
                                    <br>
                                    <br>
                                    <label>Éléments du Service</label>
                                    <br>
                                    <ol>
                                        <li></li>
                                    </ol>
                                </div>
                                <div class="col-sm-10" id="service2" style="display: none">
                                    <br>
                                    <br>
                                    <label>Éléments du Service</label>
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
                                    <label>Éléments du Service</label>
                                    <br>
                                    <ol>
                                        <li>Hébergement</li>
                                        <li>Transport Standard ou Médicalisé</li>
                                        <li>Restauration</li>
                                        <li>Accompagnement</li>
                                    </ol>
                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <i style="color: black">Les estimations sont pour une seule personne et sur un seul
                                    mois.</i>
                                <br><br>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Valider</button>

                        </form>

                        <br>
                        <br>
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
                                            <input type="text" style="width: 100%" name="q"
                                                class="form-control form-control-lg" id="sick" placeholder="Cancer, ...">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Recherche</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- =============================
                                                                    End: Search
                                                                ============================= -->
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
