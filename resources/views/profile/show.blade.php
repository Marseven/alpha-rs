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
        <div class="container">
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
                                                <span class="ml-2">D??connexion </span>
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
                                        <h6 class="mb-0">T??l??phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->phone }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#userModalView">Mettre ?? Jour</button>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#passwordModal">R??initialiser le Mot de passe</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="d-flex align-items-center mb-3">Dossier M??dical</h6>
                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                                            data-target="#folderModal">Cr??er</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @if ($user->folders->count() > 0)
                                                        @foreach ($user->folders as $folder)
                                                            <tr>
                                                                <td>Dossier #{{ $folder->reference }}</td>
                                                                <td>
                                                                    <a class="btn btn-small" data-toggle="modal"
                                                                        data-target="#folderModalView{{ $folder->id }}"><i
                                                                            class="fa fa-eye"></i></a>
                                                                    <a class="btn btn-small" data-toggle="modal"
                                                                        data-target="#folderPay{{ $folder->id }}"
                                                                        title="Payer">P</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="d-flex align-items-center mb-3">Demande de Devis</h6>
                                        <a href="{{ route('quote') }}" class="btn btn-success mb-2">Cr??er</a>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>

                                                    @foreach ($quotes as $quote)
                                                        <tr>
                                                            <td>Devi #{{ $quote->reference }}</td>
                                                            <td>
                                                                <a class="btn btn-small" data-toggle="modal"
                                                                    data-target="#quoteModalView{{ $quote->id }}"><i
                                                                        class="fa fa-eye"></i></a>

                                                                @if ($quote->status > 1)
                                                                    <a class="btn btn-small" data-toggle="modal"
                                                                        data-target="#responseModal{{ $quote->id }}">R</a>
                                                                @endif

                                                                @if ($quote->folder == false && $quote->status > 1)
                                                                    <a class="btn btn-small" data-toggle="modal"
                                                                        data-target="#quoteModal{{ $quote->id }}"><i
                                                                            class="fa fa-upload"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters-sm">
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
                                                        <th>N?? Produit</th>
                                                        <th>Montant</th>
                                                        <th>ID Transaction</th>
                                                        <th>Op??rateur</th>
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
                                                        <th>N?? Produit</th>
                                                        <th>Montant</th>
                                                        <th>ID Transaction</th>
                                                        <th>Op??rateur</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <h5 class="modal-title" id="exampleModalCenterTitle">Devis N??{{ $quote->reference }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <!-- text -->
                                <h6 class="text-uppercase fs-5 ls-2">Informations du Devis</h6>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Nom & Pr??nom </h6>
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
                                <h6 class="text-uppercase fs-5 ls-2">Cat??gorie</h6>
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
                                <h6 class="text-uppercase fs-5 ls-2">Pi??ce Jointe</h6>
                                <a class="btn btn-info" href="{{ asset($quote->join_piece) }}">T??l??charger</a>
                            </div>
                            <div class="col-6  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Statut</h6>
                                @php
                                    $status = App\Http\Controllers\Controller::status($quote->status);
                                @endphp
                                <p class="mb-0">{{ $status }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
                        @if ($quote->status == 0)
                            <a href="{{ url('/quote-pay/' . $quote->id) }}"><button type="submit"
                                    class="btn btn-primary">Payer</button></a>
                        @endif
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
                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ $folder->reference }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <!-- text -->
                                    <h6 class="text-uppercase fs-5 ls-2">Informations du Dossier</h6>
                                </div>
                                <div class="col-6 mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Nom & Pr??nom </h6>
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
                                    <h6 class="text-uppercase fs-5 ls-2">Cat??gorie</h6>
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
                                    <h6 class="text-uppercase fs-5 ls-2">Pi??ce Jointe</h6>
                                    <a class="btn btn-info" href="{{ asset($folder->join_piece) }}">Download</a>
                                </div>
                                <div class="col-6  mb-5">
                                    <h6 class="text-uppercase fs-5 ls-2">Montant total ?? payer</h6>
                                    <p class="mb-0">
                                        {{ number_format($folder->price + $folder->service->price, 0, ',', ' ') }} XAF
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
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
                            ??tes-vous s??r de vouloir payer pour ce dossier m??dical ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
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
                        <h5 class="modal-title" id="exampleModalCenterTitle">Devis N??{{ $quote->reference }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <!-- text -->
                                <h6 class="text-uppercase fs-5 ls-2">R??ponse du Devis</h6>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Nom & Pr??nom </h6>
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
                                <h6 class="text-uppercase fs-5 ls-2">Cat??gorie</h6>
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
                                <p class="mb-0">{{ $status }}</p>
                            </div>
                            <div class="col-12  mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">R??ponse</h6>
                                <p>{{ $quote->response ?? 'Aucune R??ponse Pour le Moment' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
                        @if ($quote->status == 0)
                            <a href="{{ url('/quote-pay/' . $quote->id) }}"><button type="submit"
                                    class="btn btn-primary">Payer</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="userModalView">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre ?? Jour Mes informations</h5>
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
                            <label for="phone" class="col-form-label">T??l??phone</label>
                            <input type="text" value="{{ $user->phone }}" class="form-control" name="phone">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre ?? jour le mot de passe</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/userpassword/' . $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Ancien mot de passe</label>
                            <input type="password" class="form-control" name="lastpassword">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Confirm?? le mot de passe</label>
                            <input type="password" class="form-control" name="password_confirmed">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Cr??er un Dossier</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('quote') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCategory">Cat??gorie</label>
                                <select id="inputCategory" class="form-control">
                                    <option selected>Choisir...</option>
                                    <option>Particulier</option>
                                    <option>Entreprise</option>
                                    <option>Assurance</option>
                                    <option>??tablissement Sanitaire</option>
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
                                <label for="inputFirstname4">Pr??nom</label>
                                <input type="text" name="firstname" class="form-control" id="inputPassword4"
                                    placeholder="Pr??nom">
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
                                    <option value="F">F??minin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail"
                                placeholder="nom.premon@domaine.com">
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">T??l??phone</label>
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
                                <label for="inputService">Service Sollicit??</label>
                                <select name="service_id" id="inputService" class="form-control">
                                    <option selected>Choisir...</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPjoin">Pi??ce Jointe du dossier m??dical</label>
                            <input type="file" name="join_piece" class="form-control" id="inputPjoin">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
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
                        <h5 class="modal-title" id="exampleModalCenterTitle">Cr??ation de dossier</h5>
                    </div>
                    <div class="modal-body">
                        ??tes-vous s??r de vouloir cr??er un dossier ?? partir de ce devis ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferm??</button>
                        <form action="{{ url('folder/quote/' . $quote->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="delete" value="true">
                            <button type="submit" class="btn btn-success">Cr??er</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins-init/datatables.init.js') }}"></script>

@endpush
