@extends('layouts.default')

@push('styles')
    <!-- Main Style Css -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bd-wizard.css') }}" />
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


    @include('layouts.flash')

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

                <div class="d-flex align-items-center">
                    <div class="container">
                        <form action="{{ route('simulate') }}" id="form" method="POST">
                            @csrf
                            <div id="wizard">
                                <h3>1</h3>
                                <section>
                                    <h5 class="bd-wizard-step-title">Étape 1</h5>
                                    <h2 class="section-heading">Choisissez le Pays de destination </h2>

                                    <div class="form-group">
                                        <label for="country_id" class="sr-only">Pays</label>
                                        <select name="country_id" class="form-control" style="padding: 0.375rem 0.75rem;">
                                            @foreach ($countries as $ct)
                                                <option value="{{ $ct->id }}">{{ $ct->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </section>
                                <h3>2</h3>
                                <section>
                                    <h5 class="bd-wizard-step-title">Étape 2</h5>
                                    <h2 class="section-heading">Choisissez le Service</h2>
                                    <div class="purpose-radios-wrapper">
                                        @foreach ($services as $sv)
                                            <div class="purpose-radio" id="purpose{{ $sv->id }}">
                                                <input type="radio" name="service_id" id="{{ $sv->label }}"
                                                    class="purpose-radio-input" value="{{ $sv->id }}">
                                                <label for="{{ $sv->label }}" class="purpose-radio-label">
                                                    <span class="label-icon">
                                                        <i class="flaticon-medical-insurance"></i>
                                                        {{-- <img src="assets/images/icon_branding.svg" alt="{{ $sv->label }}"
                                                            class="label-icon-default">
                                                        <img src="assets/images/icon_branding_green.svg"
                                                            alt="{{ $sv->label }}" class="label-icon-active"> --}}
                                                    </span>
                                                    <span class="label-text">{{ $sv->label }}</span>
                                                    <br>
                                                    <span class="label-text" id="price{{ $sv->id }}"
                                                        style="display: none">{{ number_format($sv->price, 0, ',', ' ') }}
                                                        XAF</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </section>
                                <h3>3</h3>
                                <section>
                                    <h5 class="bd-wizard-step-title">Étape 3</h5>
                                    <h2 class="section-heading mb-5">Choisissez la Pathologie</h2>
                                    <div class="form-group">
                                        <label for="sick_id" class="sr-only">Pathologie</label>
                                        <select name="sick_id" class="form-control" style="padding: 0.375rem 0.75rem;">
                                            @foreach ($sicks as $sc)
                                                <option value="{{ $sc->id }}">{{ $sc->label }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </section>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/js/bd-wizard.js') }}"></script>

    <script language="JavaScript">
        $(function() {

            @foreach ($services as $sv)
                let d{{ $sv->id }} = document.getElementById("purpose{{ $sv->id }}");
                let p{{ $sv->id }} = document.getElementById("price{{ $sv->id }}");

                d{{ $sv->id }}.addEventListener("mouseover", () => {
                    p{{ $sv->id }}.style.display = "block";
                });
                d{{ $sv->id }}.addEventListener("mouseout", () => {
                    p{{ $sv->id }}.style.display = "none";
                });
            @endforeach

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
