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
                        <h1 class="heading-font">Foire Aux Questions</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>
                                <p>FAQ</p>
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
                <div class="col-md-4">
                    <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
                        <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1"
                            aria-selected="true">
                            Comment Obtenir un devis ?
                        </a>
                        <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2"
                            aria-selected="false">
                            Après combien de temps dois-je rentrer en possession de devis ?
                        </a>
                        <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3"
                            aria-selected="false">
                            Avec l’utilisation du simulateur peut-on obtenir le coût du séjour ?
                        </a>
                        <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab4"
                            aria-selected="false">
                            Quel avantage d’utiliser le compte Espace Client ?
                        </a>
                        <a href="#tab5" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab5"
                            aria-selected="false">
                            Comment entrer en contact avec un responsable ?
                        </a>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content" id="faq-tab-content">
                        <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                            <div class="faq-inner">
                                <p> Veuillez renseigner la rubrique devis en téléversant les documents demandés.

                                </p>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                            <div class="faq-inner">
                                <p> 72H
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                            <div class="faq-inner">
                                <p> Tout dépendra des pathologies renseigner dans le moteur recherche
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
                            <div class="faq-inner">
                                <p> Avoir un compte Espace Client permettra aux clients de suivre la procédure
                                    administrative de son dossier
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5" role="tabpanel" aria-labelledby="tab4">
                            <div class="faq-inner">
                                <p> Nous avons mis en place un numéro WhatsApp pour des discussions instantanées</p>
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
