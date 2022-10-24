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
                        <h1 class="heading-font">Conditions Générales D'Utilisation</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>
                                <p>CGU</p>
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
    <section id="faq" class="faq section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content" id="faq-tab-content">
                        <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                            <div class="faq-inner">
                                <p> Veuillez renseigner la rubrique devis en téléversant les documents demandés.

                                </p>

                            </div>
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
