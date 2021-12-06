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
                        <h1 class="heading-font">DEVIS</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>
                                <p>Devis</p>
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
    <section id="aboutus" class="aboutus aboutpage section">
        <div class="container">
            <div class="row about-page-para">
                <div class="col-lg-7 col-md-7 text-left">
                    <div class="about-page-in">
                        <div class="heading b-text">
                            <h5>Vous souhaitez vous soignez à l'étranger ?</h5>
                            <h2>Demandez un Devis</h2>
                        </div>

                        <form method="POST" action="{{ route('quote') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCategory">Catégorie</label>
                                    <select name="category" id="inputCategory" class="form-control">
                                        <option selected>Choisir...</option>
                                        <option>Particulier</option>
                                        <option>Entreprise</option>
                                        <option>Assurance</option>
                                        <option>Établissement Sanitaire</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputLastname4">Nom</label>
                                    <input type="text" name="lastname" class="form-control" id="inputEmail4"
                                        placeholder="Nom" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstname4">Prénom</label>
                                    <input type="text" name="firstname" class="form-control" id="inputPassword4"
                                        placeholder="Prénom">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputBirthday">Date de Naissance</label>
                                    <input type="date" name="birthday" class="form-control" id="inputBirthday">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputGender">Genre</label>
                                    <select id="inputGender" class="form-control" name="gender">
                                        <option selected>Choisir...</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail"
                                    placeholder="nom.premon@domaine.com">
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Téléphone</label>
                                <input type="phone" name="phone" class="form-control" id="inputPhone"
                                    placeholder="074010203">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCountry">Pays de destination</label>
                                    <select name="country_id" id="inputCountry" class="form-control">
                                        @if ($country_check)
                                            <option value="{{ $country_check->id }}">{{ $country_check->label }}
                                            </option>
                                        @else
                                            <option selected>Choisir...</option>
                                        @endif
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputService">Service Sollicité</label>
                                    <select name="service_id" id="inputService" class="form-control">
                                        @if ($service_check)
                                            <option value="{{ $service_check->id }}">{{ $service_check->label }}
                                            </option>
                                        @else
                                            <option selected>Choisir...</option>
                                        @endif
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPjoin">Pièce Jointe du dossier médical</label>
                                <input type="file" name="join_piece" class="form-control" id="inputPjoin">
                            </div>

                            <div class="col-12">
                                <i style="color: red">Les frais d'ouverture de dossier s'élève à 50 000 XAF.</i><br>
                                <i style="color: red">Votre demande de devis ne sera traité qu'une fois les frais
                                    réglés et sera disponible dans 72 heures maximum.</i>
                                <br><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                    <label class="form-check-label" for="gridCheck">
                                        Accepter les termes et conditions d'utilisation
                                    </label>
                                </div>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Payer</button>
                        </form>
                    </div>

                </div>
                <div class="col-lg-5 col-md-5 text-left">
                    <div class="">
                        <img class="img-fluid about-page2" src="{{ asset('images/about-image-2.png') }}" alt="about">
                    </div>

                </div>
            </div>


        </div>
    </section>

    <!-- =============================
                                End: About Us
                            ============================= -->

@endsection
