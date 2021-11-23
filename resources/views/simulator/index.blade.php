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
                                    <select name="service_id" id="service_id" class="form-control service_id"
                                        onChange="afficherService()">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-10" id="service-1" style="display: none">
                                    <br>
                                    <br>
                                    <label>Éléments du Service</label>
                                    <br>
                                    <ol>
                                        <li>Hospitalisation</li>
                                    </ol>
                                </div>
                                <div class="col-sm-10" id="service-2" style="display: none">
                                    <br>
                                    <br>
                                    <label>Éléments du Service</label>
                                    <br>
                                    <ol>
                                        <li>Hospitalisation</li>
                                        <li>Hébergement</li>
                                        <li>Transport Standard</li>
                                        <li>Restauration</li>
                                    </ol>
                                </div>
                                <div class="col-sm-10" id="service-3" style="display: none">
                                    <br>
                                    <br>
                                    <label>Éléments du Service</label>
                                    <br>
                                    <ol>
                                        <li>Hospitalisation</li>
                                        <li>Hébergement</li>
                                        <li>Transport Standard ou Médicalisé</li>
                                        <li>Restauration</li>
                                        <li>Accompagnement</li>
                                    </ol>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Valider</button>

                        </form>
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
        function afficherService() {
            var service1 = document.getElementById("service-1");
            var service2 = document.getElementById("service-2");
            var service2 = document.getElementById("service-3");

            if (document.form_simu.service_id.value == "1") {
                service1.style.display = "block";
                service2.style.display = "none";
                service3.style.display = "none";
            }

            if (document.form_simu.serice_id.value == "2") {
                service1.style.display = "none";
                service2.style.display = "block";
                service3.style.display = "none";
            }

            if (document.form_simu.serice_id.value == "3") {
                service1.style.display = "none";
                service2.style.display = "none";
                service3.style.display = "block";
            }
        }
    </script>
@endpush
