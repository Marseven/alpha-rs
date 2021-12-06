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

    <!--====================
                                            Breadcrum Part HTML End
                                        ======================-->

    <!-- =============================
                                            Start: About Us
                                        ============================= -->
    <section id="service" class="service section">
        <div class="container">
            <div class="row">

                <div class="col-12 ">
                    <div class="heading b-text text-center">
                        <h2>Estimations des prix</h2>
                    </div>
                </div>

            </div>

            <!-- =============================
                                                    Start: Search
                                                ============================= -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('simulate') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pays</label>
                                <div class="col-sm-10">
                                    <select id="selectOne" name="country_id" class="form-control">
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
                            <div class="row mb-3">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =============================
                                                    End: Search
                                                ============================= -->

            <br>

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
                            <th>Prix Minimal</th>
                            <th>Prix Maximal</th>
                        </thead>
                        <tbody>
                            @php
                                $total1 = $service_id->price;
                                $total2 = $service_id->price;
                            @endphp
                            @foreach ($simulators as $simulator)
                                <tr>
                                    <td><strong>{{ $simulator->label }}</strong></td>
                                    <td>{{ number_format($simulator->price_min, 0, ',', ' ') }} XAF</td>
                                    <td>{{ number_format($simulator->price_max, 0, ',', ' ') }} XAF</td>
                                </tr>
                                @php
                                    $total1 += $simulator->price_min;
                                    $total2 += $simulator->price_max;
                                @endphp
                            @endforeach

                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ number_format($total1, 0, ',', ' ') }} XAF</strong></td>
                                <td><strong>{{ number_format($total2, 0, ',', ' ') }} XAF</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
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
