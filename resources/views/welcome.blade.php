@extends('layouts.default')

@section('content')

    <!-- =============================
                                Start: Header Slider
                            ============================= -->
    <div class="tg-sliderholder">
        <div id="tg-homeslider" class="tg-homeslider tg-haslayout" style="padding-bottom: 0!important">
            <div class="pogoSlider-slide" data-transition="fade" data-duration="600"
                style="background:url(images/slider.png) no-repeat scroll center center;">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                            <div class="tg-slidercontent " data-transition="blocksReveal">
                                <h6 class="pogoSlider-slide-element" data-in="slideUp" data-duration="800" data-delay="500">
                                    Alpha</h6>
                                <h1 class="pogoSlider-slide-element" data-in="slideDown" data-duration="800"
                                    data-delay="500"><span>Évacuation </span>
                                    Sanitaire</h1>
                                <p>Nous vous accompagnos dans la procédure de bout en bout.</p>

                                <a class="btn-shape btn banner-btn btn-4" data-in="slideUp" data-out="slideDown"
                                    data-duration="800" data-delay="300" href="{{ route('quote') }}">Demander un Devis</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pogoSlider-slide" data-transition="expandReveal" data-duration="1000"
                style="background:url(images/slider2.png) no-repeat scroll center center;">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                            <div class="tg-slidercontent">
                                <h6 class="pogoSlider-slide-element" data-in="slidedown" data-duration="800"
                                    data-delay="500">Alpha</h6>
                                <h1 class="pogoSlider-slide-element" data-in="slideUp" data-duration="800" data-delay="500">
                                    <span>Assistance</span>
                                    Sanitaire
                                </h1>
                                <p>Nous sommes là pour vous car votre santé est important pous nous.</p>

                                <a class="btn-shape btn banner-btn btn-4" data-in="slideUp" data-out="slideDown"
                                    data-duration="800" data-delay="300" href="{{ route('quote') }}">Demander un Devis</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- =============================
                                End: Header Slider
                            ============================= -->


    @include('layouts.flash')

    <!-- =============================
                                Start: About Us
                            ============================= -->
    <section id="aboutus" class="aboutus section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 text-center no-padding">
                    <div class="about-col">
                        <img class="img-fluid about-img" src="images/about-image.png" alt="about">
                    </div>

                </div>

                <div class="col-lg-7 col-md-8 text-left pl0">
                    <div class="about-cont">
                        <div class="heading b-text">
                            <h5>Mieux nous connaître</h5>
                            <h2>À Propos de Alpha</h2>
                        </div>

                        <p>
                            Est vous déjà posez la question de savoir comment procéder à une évacuation sanitaire ?
                            Alpha est solution numérique permettant de faciliter la prise en charge des patients
                            souhaitant se faire soigner à l’étranger dans le cadre d’une Evacuation Sanitaire ou d’un bilan
                            médical de santé.
                            Notre solution numérique Alpha vous permettra de Gagnez en temps dans vos démarches
                            administrative, vos rendez-vous médicaux en un temps record, votre logement et transport sont
                            réservés.
                        </p>
                    </div>

                </div>
                <div class="col-lg-9 offset-lg-3 col-md-12">
                    <div class="row justify-content-center fun-facts-area">
                        <div class="col-md-1 col-3 no-padding">
                            <div class="about-icon1">
                                <i class="flaticon-family"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col-9">
                            <div class="fun-facts-item">
                                <h3 class="title odometer" data-count="8">00</h3>
                                <span>+ Clients</span>
                                <p>Heureux</p>
                            </div>
                        </div>
                        <div class="col-md-1 col-3 no-padding">
                            <div class="about-icon1">
                                <i class="flaticon-medical-insurance"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col-9">
                            <div class="fun-facts-item">
                                <h3 class="title odometer" data-count="4">00</h3>
                                <span>+ Services</span>
                                <p>de Qualitées</p>
                            </div>
                        </div>
                        <div class="col-md-1 col-3 no-padding">
                            <div class="about-icon1">
                                <i class="flaticon-certificate"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col-9">
                            <div class="fun-facts-item">
                                <h3 class="title odometer" data-count="4">00</h3>
                                <span>+ Années</span>
                                <p>d'Expériences</p>
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

    <!-- =============================
                                Start: service Part
                            ============================= -->

    <section id="service" class="service section">
        <div class="container">
            <div class="row">

                <div class="col-12 ">
                    <div class="heading b-text text-center">
                        <h5>Découvrez nos offres</h5>
                        <h2>Nos Services</h2>
                    </div>
                </div>

            </div>

        </div>
        <div class="container">
            <div class="row service-slick">
                @foreach ($services as $service)
                    <div class="col-md-4">
                        <div class="service-inner text-center">
                            <div>
                                <i class="flaticon-medical-insurance"></i>
                            </div>
                            <h5>{{ $service->label }} <br><br> <span
                                    class="badge badge-pill badge-info">{{ number_format($service->price, 0, ',', ' ') }}
                                    XAF</span></h5>
                            <p>{{ $service->description }}</p>
                            <div><a class="btn btn-4 btn-ser" href="{{ url('quote/service/' . $service->id) }}">Devis</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if ($services->count() == 0)
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Aucun Service pour le moment !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <br>
            <br>
            <div class="container">
                <div class="row">

                    <div class="col-12 ">
                        <div class="heading b-text text-center">
                            <h5>Les maladies traitées</h5>
                            <h2>Les Pathologies</h2>
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
                            <h2><span class="badge badge-pill badge-info">Aucune Maladie Pour le Moment</span></h2>
                        @endif
                    </div>
                </div>
            </div>
            <!-- =============================
                                        End: Search
                                    ============================= -->

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
                                <input type="text" style="width: 100%" name="q" class="form-control form-control-lg"
                                    id="sick" placeholder="Cancer, ...">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Recherche</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =============================
                                        End: Search
                                    ============================= -->
            <br>
            <br>
            <br>
            <div class="container">
                <div class="row">

                    <div class="col-12 ">
                        <div class="heading b-text text-center">
                            <h5>Vous souhaitez avoir une estimation ?</h5>
                            <h2>Simulateur</h2>
                        </div>
                    </div>
                </div>
            </div>

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
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Offres</label>
                                <div class="col-sm-10">
                                    <select name="service_id" class="form-control" onChange="afficherservice()">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============================
                                End: service Part
                            ============================= -->

    <!-- =============================
                                Start: Experience Part
                            ============================= -->

    <section id="experience" class="experience">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 text-center">
                    <img class="img-fluid" src="images/why-choose-us-image.png" alt="about">
                </div>
                <div class="col-lg-7 exp-pad pl0">
                    <div class="row exp-in">
                        <div class="col-lg-3 col-md-12 text-center">
                            <img src="images/experience.png" class="img-fluid exp" alt="experienced" />
                        </div>
                        <div class="col-lg-9 col-md-12 pl0">
                            <div class="exp-text">
                                <h5>Des années d'expériences</h5>
                                <h4>Dans l'assistance et l'évacuation sanitaire</h4>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="exp-txt">
                                <p>
                                    Relief Services a sélectionné pour vous les meilleurs hôpitaux en Tunisie, Maroc,
                                    Afrique du sud et France. Notre équipe d’assistance est présente pour veiller à ce que
                                    vos rendez-vous et séjours se passent dans les bonnes conditions. Le secret
                                    professionnel, institué dans l’intérêt des patients, s’impose à Relief Services.
                                </p>

                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="row exp-ser-in">
                                <div class="col-md-3 col-3">
                                    <div class="exp-icon1">
                                        <i class="flaticon-job-search"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <div class="exp-ser">
                                        <h4>100%</h4>
                                        <p>Transparent</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row exp-ser-in">
                                <div class="col-md-3 col-3">
                                    <div class="exp-icon1">
                                        <i class="flaticon-car-insurance"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <div class="exp-ser">
                                        <h4>4 pays</h4>
                                        <p>Destination de qualité</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row exp-ser-in">
                                <div class="col-md-3 col-3">
                                    <div class="exp-icon1">
                                        <i class="flaticon-family"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <div class="exp-ser">
                                        <h4>24X7</h4>
                                        <p>Support</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row exp-ser-in">
                                <div class="col-md-3 col-3">
                                    <div class="exp-icon1">
                                        <i class="flaticon-password"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <div class="exp-ser">
                                        <h4>100%</h4>
                                        <p>Sûr</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =============================
                                End: Experience Part
                            ============================= -->
    <!-- =============================
                                Start: Testimonial Part
                            ============================= -->
    <section id="testimonial" class="testimonial section">
        <div class="container">
            <div class="row">

                <div class="col-12 ">
                    <div class="heading w-text text-center">
                        <h5>Un seul objectif, vous satisfaire</h5>
                        <h2>Témoiganges</h2>
                    </div>
                </div>

            </div>
            <div class="row testimonial-slick">
                <div class="col-md-6">
                    <div class="tes-inner">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="test-img">
                                    <img src="images/testimonial-image-1.png" class="img-fluid" alt="testimonial" />
                                </div>

                            </div>
                            <div class="col-md-9 pl0">
                                <div class="test-txt">
                                    <h4>Michel Obiang</h4>
                                    <p>Médécin</p>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="test-para">
                                    <p>Je recommande la solution Alpha car elle permet à mes patients de bénéficier des
                                        meilleurs soins.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tes-inner">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="test-img">
                                    <img src="images/testimonial-image-4.png" class="img-fluid" alt="testimonial" />
                                </div>

                            </div>
                            <div class="col-md-9 pl0">
                                <div class="test-txt">
                                    <h4>Carla Mbadinga</h4>
                                    <p>Malade</p>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="test-para">
                                    <p>Grâce à Alpha, j'ai pu me soigner au Maroc et depuis il est plus facile pour moi de
                                        suivre mon dossier médicale.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tes-inner">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="test-img">
                                    <img src="images/testimonial-image-3.png" class="img-fluid" alt="testimonial" />
                                </div>

                            </div>
                            <div class="col-md-9 pl0">
                                <div class="test-txt">
                                    <h4>Jean Aliangha</h4>
                                    <p>Client</p>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="test-para">
                                    <p>L'assistance et le suivie de Relief Services m'ont permis de trouver la meilleure
                                        destinantion pour soigner ma fille.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- =============================
                                End: Testimonial Part
                            ============================= -->
    <!--========================
                             Team Part HTML Start
                            ==========================-->
    <section id="team" class="team section">
        <div class="container">
            <div class="row">

                <div class="col-12 ">
                    <div class="heading b-text text-center">
                        <h5>Des Villes et Hôpitaux de qualité</h5>
                        <h2>Nos Destinations</h2>
                    </div>
                </div>

            </div>

            <div class="row doctor-slick">
                @foreach ($towns as $town)
                    <div class="col-md-4">
                        <div class="team-inner">
                            <div class="team-img text-center">
                                <img src="{{ asset($town->picture) }}" class="img-fluid" alt="team">
                            </div>
                            <div class="team-txt text-center">
                                <h4>{{ $town->label }}</h4>
                                <p class="team-border">{{ $town->country->label }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($towns->count() == 0)
                    <div class="col-md-12">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            Aucune destination pour le moment !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!--======================
                             Team Part HTML End
                            =======================-->
    <!--======================
                                Latest Updates Part HTML Start
                            =======================-->

    <section id="contactus" class="blog section">
        <div class="container">
            <div class="row">

                <div class="col-12 ">
                    <div class="heading b-text text-center">
                        <h5>Nous sommes Disponible pour vous</h5>
                        <h2>Entrer en Contact</h2>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63835.662901823234!2d9.447716099999997!3d0.38353399999999355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x107f3b91a1b2f065%3A0x38aa4a66b57072f1!2sMontagne%20Sainte%2C%20Libreville!5e0!3m2!1sfr!2sga!4v1626723504345!5m2!1sfr!2sga"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-7 blog-right">
                    <form method="POST" action="{{ route('contact') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNom4">Nom Complet</label>
                                <input type="text" name="name" class="form-control" id="inputEmail4"
                                    placeholder="Nom Complet">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPhone4">Téléphone</label>
                                <input type="text" name="phone" class="form-control" id="inputPhone4"
                                    placeholder="074010203">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail"
                                placeholder="nom.prenom@domaine.com">
                        </div>
                        <div class="form-group">
                            <label for="inputSubject">Sujet</label>
                            <input type="text" name="subject" class="form-control" id="inputSubject" placeholder="Sujet">
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Message</label>
                            <textarea type="text" name="message" class="form-control"
                                id="inputMessage">Message...</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Contacter</button>
                    </form>
                </div>
            </div>

        </div>

    </section>

    <!--======================
                                Blog Part HTML End
                            =======================-->

@endsection
