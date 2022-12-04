@extends('layouts.default')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
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
                        <h1 class="heading-font">Espace Client</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li>
                                <p>{{ $user->name }}</p>
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
                                                                                                                                                                                                                                Start: Profil
                                                                                                                                                                                                                            ============================= -->
    <section id="aboutus" class="aboutus aboutpage section">
        <div class="full-width" style="padding: 1.5%">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset($user->picture ? $user->picture : 'images/blank.png') }}"
                                        alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-secondary mb-1">{{ $user->email }}</p>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-4 btn-ser">
                                                <span class="ml-2">Déconnexion </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom Complet</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Téléphone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->phone }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#userModalView">Mettre à Jour</button>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#passwordModal">Réinitialiser le Mot de passe</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters-sm">

                            <div class="col-sm-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="d-flex align-items-center mb-3">Mes Demandes de Devis</h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table id="example" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nom Complet</th>
                                                        <th>Date de Naissance</th>
                                                        <th>Genre</th>
                                                        <th>Téléphone</th>
                                                        <th>Statut</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($quotes as $quote)
                                                        <tr>
                                                            <td>{{ $quote->id }}</td>
                                                            <td>{{ $quote->lastname . ' ' . $quote->firstname }}</td>
                                                            <td>{{ $quote->birthday }}</td>
                                                            <td>{{ $quote->gender }}</td>
                                                            <td>{{ $quote->phone }}</td>
                                                            @php
                                                                $status = App\Http\Controllers\Controller::status($quote->status);
                                                            @endphp
                                                            <td> <span
                                                                    class="badge badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-small" data-toggle="modal"
                                                                    data-target="#quoteModalView{{ $quote->id }}">Voir</a>

                                                                @if ($quote->status > 1)
                                                                    <a class="btn btn-small" data-toggle="modal"
                                                                        data-target="#responseModal{{ $quote->id }}">Réponse</a>

                                                                    <a class="btn btn-small" data-toggle="modal"
                                                                        data-target="#payModal">Payer</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nom Complet</th>
                                                        <th>Date de Naissance</th>
                                                        <th>Genre</th>
                                                        <th>Téléphone</th>
                                                        <th>Statut</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row gutters-sm">
                            <div class="col-sm-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3">Liste de mes Paiements</h6>
                                        <div class="table-responsive">
                                            <table id="example" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Reference</th>
                                                        <th>N° Produit</th>
                                                        <th>Montant</th>
                                                        <th>ID Transaction</th>
                                                        <th>Opérateur</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($payments as $payment)
                                                        <tr>
                                                            <td>{{ $payment->id }}</td>
                                                            <td>{{ $payment->reference }}</td>
                                                            <td>{{ $payment->folder_id ? 'DOSSIER' : 'DEVIS' }}</td>
                                                            <td>{{ number_format($payment->amount, 0, ',', ' ') }} XAF
                                                            </td>
                                                            <td>{{ $payment->transaction_id }}</td>
                                                            <td>{{ $payment->operator }}</td>
                                                            @php
                                                                $status = App\Http\Controllers\Controller::status($payment->status);
                                                            @endphp
                                                            <td>{{ $status }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Reference</th>
                                                        <th>N° Produit</th>
                                                        <th>Montant</th>
                                                        <th>ID Transaction</th>
                                                        <th>Opérateur</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>

            </div>
        </div>
    </section>


    @foreach ($quotes as $quote)
        @php
            $quote->load(['service', 'country']);
        @endphp

        <div class="modal fade" id="quoteModalView{{ $quote->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Devis N°{{ $quote->id }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <!-- text -->
                                <h6 class="text-uppercase fs-5 ls-2">Informations du Devis</h6>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Nom & Prénom </h6>
                                <p class="mb-0">{{ $quote->firstname }} {{ $quote->lastname }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Contacts </h6>
                                <p class="mb-0">{{ $quote->email }} - {{ $quote->phone }} </p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Date de Naissance </h6>
                                <p class="mb-0">{{ $quote->birthday }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                                <p class="mb-0">{{ $quote->category }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Service
                                </h6>
                                <p class="mb-0">{{ $quote->service->label }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Pays
                                </h6>
                                <p class="mb-0">{{ $quote->country->label }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Pièce Jointe</h6>
                                <a class="btn btn-info" href="{{ asset($quote->join_piece) }}">Télécharger</a>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Statut</h6>
                                @php
                                    $status = App\Http\Controllers\Controller::status($quote->status);
                                @endphp
                                <p class="mb-0"><span
                                        class="badge badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @if ($user->folders->count() > 0)
        @foreach ($user->folders as $folder)
            <div class="modal fade" id="folderModalView{{ $folder->id }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ $folder->id }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <!-- text -->
                                    <h6 class="text-uppercase fs-5 ls-2">Informations du Dossier</h6>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Nom & Prénom </h6>
                                    <p class="mb-0">{{ $folder->firstname }} {{ $folder->lastname }}</p>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Contacts </h6>
                                    <p class="mb-0">{{ $folder->email }} - {{ $folder->phone }} </p>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Date de Naissance </h6>
                                    <p class="mb-0">{{ $folder->birthday }}</p>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                                    <p class="mb-0">{{ $folder->category }}</p>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Service
                                    </h6>
                                    <p class="mb-0 mb-5">{{ $folder->service->label }}</p>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Pays
                                    </h6>
                                    <p class="mb-0 mb-5">{{ $folder->country->label }}</p>
                                </div>
                                <hr>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Pièce Jointe</h6>
                                    <a class="btn btn-info" href="{{ asset($folder->join_piece) }}">Download</a>
                                </div>
                                <div class="col-6  mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Montant total à payer</h6>
                                    <p class="mb-0">
                                        {{ number_format($folder->price + $folder->service->price, 0, ',', ' ') }} XAF
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="#folderPay{{ $folder->id }}">Payer</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($user->folders as $folder)
            <!-- Modal -->
            <div class="modal fade" id="folderPay{{ $folder->id }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Paiement de dossier</h5>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir payer pour ce dossier médical ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                            <form action="{{ url('folder/pay/' . $folder->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="delete" value="true">
                                <button type="submit" class="btn btn-success">Payer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @foreach ($quotes as $quote)
        @php
            $quote->load(['service', 'country']);
        @endphp

        <div class="modal fade" id="responseModal{{ $quote->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Devis N°{{ $quote->id }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <!-- text -->
                                <h6 class="text-uppercase fs-5 ls-2">Réponse du Devis</h6>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Nom & Prénom </h6>
                                <p class="mb-0">{{ $quote->firstname }} {{ $quote->lastname }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Contacts </h6>
                                <p class="mb-0">{{ $quote->email }} - {{ $quote->phone }} </p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Date de Naissance </h6>
                                <p class="mb-0">{{ $quote->birthday }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                                <p class="mb-0">{{ $quote->category }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Service
                                </h6>
                                <p class="mb-0">{{ $quote->service->label }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Pays
                                </h6>
                                <p class="mb-0">{{ $quote->country->label }}</p>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Statut</h6>
                                @php
                                    $status = App\Http\Controllers\Controller::status($quote->status);
                                @endphp
                                <p class="mb-0"><span
                                        class="badge badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                </p>
                            </div>
                            <div class="col-12  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Réponse</h6>
                                <p>{{ $quote->response ?? 'Aucune Réponse Pour le Moment' }}</p>
                                <br>
                                @if ($quote->devis != null)
                                    <a class="btn btn-info" href="{{ asset($quote->devis) }}">Télécharger Devis</a>
                                @endif

                            </div>
                            <div class="col-12 mb-5 text-center">

                                @if ($quote->devis != null)
                                    <a class="btn btn-small" data-toggle="modal" data-target="#payModal">Payer les
                                        Frais de service</a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="userModalView">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à Jour Mes informations</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/user/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Photo de Profil</label>
                            <input type="file" value="{{ $user->picture }}" class="form-control" name="picture">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nom Complet</label>
                            <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" value="{{ $user->email }}" class="form-control" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="col-form-label">Téléphone</label>
                            <input type="text" value="{{ $user->phone }}" class="form-control" name="phone">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="passwordModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le mot de passe</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/userpassword/' . $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Confirmé le mot de passe</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- =============================
                                                                                                                                                                                                                                End: Profil
                                                                                                                                                                                                                            ============================= -->


    <div class="modal fade" id="folderModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un Dossier</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('quote') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCategory">Catégorie</label>
                                <select id="inputCategory" class="form-control">
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
                                    <option selected>Choisir...</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputService">Service Sollicité</label>
                                <select name="service_id" id="inputService" class="form-control">
                                    <option selected>Choisir...</option>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($quotes as $quote)
        <!-- Modal -->
        <div class="modal fade" id="quoteModal{{ $quote->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Création de dossier</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir créer un dossier à partir de ce devis ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('folder/quote/' . $quote->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="delete" value="true">
                            <button type="submit" class="btn btn-success">Créer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="payModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Paiement des Frais de Service</h5>
                </div>
                <div class="modal-body">
                    Après réception du devis, souhaitez vous continuer la procédure d'assistance ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    <a href="{{ url('quote/payment/' . $quote->id) }}"><button type="button"
                            class="btn btn-success">Payer</button></a>


                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins-init/datatables.init.js') }}"></script>
@endpush
