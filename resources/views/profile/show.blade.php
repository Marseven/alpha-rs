@extends('layouts.default')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
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
                            <a href="{{route('home')}}">
                                <p>Accueil</p>
                            </a>
                        </li>
                        <li><i class="fas fa-angle-right"></i></li>
                        <li>
                            <p>{{$user->name}}</p>
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
                        <img src="{{asset($user->picture ? $user->picture : 'images/blank.png')}}" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4>{{$user->name}}</h4>
                          <p class="text-secondary mb-1">{{$user->email}}</p>
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
                            {{$user->name}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->email}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Téléphone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->phone}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#userModalView" >Mettre à Jour</button>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                      <div class="card h-100">
                        <div class="card-body">
                          <h6 class="d-flex align-items-center mb-3">Dossier Médical</h6>
                          @if (empty($user->folders))
                            <div class="row">
                                <div class="col-sm-9">
                                <h6 class="mb-0">Dossier #{{$user->folders ? $user->folders->reference : " "}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cardModalView" ><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                      <div class="card h-100">
                        <div class="card-body">
                          <h6 class="d-flex align-items-center mb-3">Demande de Devis</h6>
                            @foreach ($quotes as $quote)
                                <div class="row">
                                    <div class="col-sm-9">
                                    <h6 class="mb-0">Devis #{{$quote->reference}}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cardModalView{{$quote->id}}" ><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            @endforeach
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
                                            <th>N° Produit</th>
                                            <th>Montant</th>
                                            <th>ID Transaction</th>
                                            <th>Opérateur</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{$payment->id}}</td>
                                                <td>{{$payment->reference}}</td>
                                                <td>{{$payment->refill->number_card ?? 'ACHAT'}}</td>
                                                <td>{{$payment->amount}} XAF</td>
                                                <td>{{$payment->transaction_id}}</td>
                                                <td>{{$payment->operator}}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($payment->status);
                                                @endphp
                                                <td>{{  $status }}</td>
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
                </div>

                </div>
            </div>

        </div>
    </div>
</section>

@php
    if(empty($user->folders)) $folder = $user->folders;
@endphp

@if (empty($user->folders))
<div class="modal fade" id="cardModalView">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{$folder->reference}}</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 mb-5">
                    <!-- text -->
                    <h6 class="text-uppercase fs-5 ls-2">Informations du Dossier/h6>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Nom & Prénom </h6>
                    <p class="mb-0">{{$folder->firstname}} {{$folder->lastname}}</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Contacts </h6>
                    <p class="mb-0">{{$folder->email}} - {{$folder->phone}} </p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Date de Naissance </h6>
                    <p class="mb-0">{{$folder->birthday}}</p>
                </div>
                <div class="col-6">
                    <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                    <p class="mb-0">{{$folder->category}}</p>
                </div>
                <div class="col-6">
                    <h6 class="text-uppercase fs-5 ls-2">Service
                    </h6>
                  <p class="mb-0">{{$folder->service->label}}</p>
                </div>
                <div class="col-6">
                    <h6 class="text-uppercase fs-5 ls-2">Pays
                    </h6>
                  <p class="mb-0">{{$folder->country->label}}</p>
                </div>
                <hr>
                <div class="col-12">
                    <h6 class="text-uppercase fs-5 ls-2">Pièce Jointe</h6>
                    <a href="{{$folder->join_piece}}">Download</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
        </div>
      </div>
    </div>
</div>
@endif

@foreach ( $quotes as $quote )

<div class="modal fade" id="cardModalView{{$quote->id}}" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{$quote->reference}}</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 mb-5">
                    <!-- text -->
                    <h6 class="text-uppercase fs-5 ls-2">Informations du Devis/h6>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Nom & Prénom </h6>
                    <p class="mb-0">{{$quote->firstname}} {{$quote->lastname}}</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Contacts </h6>
                    <p class="mb-0">{{$quote->email}} - {{$quote->phone}} </p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Date de Naissance </h6>
                    <p class="mb-0">{{$quote->birthday}}</p>
                </div>
                <div class="col-6">
                    <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                    <p class="mb-0">{{$quote->category}}</p>
                </div>
                <div class="col-6">
                    <h6 class="text-uppercase fs-5 ls-2">Service
                    </h6>
                  <p class="mb-0">{{$quote->service->label}}</p>
                </div>
                <div class="col-6">
                    <h6 class="text-uppercase fs-5 ls-2">Pays
                    </h6>
                  <p class="mb-0">{{$quote->country->label}}</p>
                </div>
                <hr>
                <div class="col-12">
                    <h6 class="text-uppercase fs-5 ls-2">Pièce Jointe</h6>
                    <a href="{{$quote->join_piece}}">Download</a>
                </div>
                <div class="col-12">
                    <h6 class="text-uppercase fs-5 ls-2">Statut</h6>
                    <a href="{{$quote->join_piece}}">Download</a>
                    @php
                        $status = App\Http\Controllers\Controller::status($quote->status);
                    @endphp
                    <p class="mb-0">{{  $status }}</p>
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
          <form action="{{ url('/user/'.$user->id) }}" method="POST">
              @csrf
            <div class="mb-3">
              <label for="name" class="col-form-label">Nom Complet</label>
              <input type="text" value="{{$user->name}}" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="email" class="col-form-label">Email</label>
                <input type="email" value="{{$user->email}}" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="col-form-label">Téléphone</label>
                <input type="text" value="{{$user->phone}}" class="form-control" name="phone">
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

<!-- =============================
    End: Profil
============================= -->


@endsection

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins-init/datatables.init.js')}}"></script>

@endpush

