@extends('layouts.admin')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Devis</h4>
                        <span>Gestion des Dossiers Médicaux</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Devis</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            @include('layouts.flash-admin')
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Liste des Devis</h4>
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
                                                        class="badge-rounded badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ asset($quote->devis) }}" target="_blank"><button
                                                            type="button" class="btn btn-info"><i
                                                                class="fa fa-download"></i></button></a>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#cardModalView{{ $quote->id }}"><i
                                                            class="fa fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModal{{ $quote->id }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModalCenter{{ $quote->id }}"><i
                                                            class="fa fa-trash"></i></button>
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
        </div>
    </div>

    @foreach ($quotes as $quote)
        <div class="modal fade" id="cardModalView{{ $quote->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $quote->reference }}</h5>
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
                                <p class="mb-0">{{ $quote->email }} <br> {{ $quote->phone }} </p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Date de Naissance </h6>
                                <p class="mb-0">{{ $quote->birthday }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                                <p class="mb-0">{{ $quote->category }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Service
                                </h6>
                                <p class="mb-0">{{ $quote->service->label }}</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Pays
                                </h6>
                                <p class="mb-0">{{ $quote->country->label }}</p>
                            </div>
                            <hr>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Passport</h6>
                                <a href="{{ asset($quote->join_piece_passport) }}" target="_blank">Télécharger</a>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Examen</h6>
                                <a href="{{ asset($quote->join_piece_exam) }}" target="_blank">Télécharger</a>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Rappor</h6>
                                <a href="{{ asset($quote->join_piece_rapport) }}" target="_blank">Télécharger</a>
                            </div>
                            <div class="col-12 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Réponse</h6>
                                <p>{{ $quote->response ?? 'Aucune Réponse' }}</p>
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

    @foreach ($quotes as $quote)
        <div class="modal fade" id="cardModal{{ $quote->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Modifier un Devis</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/quotes-state/' . $quote->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Réponse du devis</label>
                                <textarea name="response" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="devis" class="col-form-label">Impoter le Devis</label>
                                <input type="file" name="devis" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Statut</label>
                                <select id="selectOne" name="status" class="form-control">
                                    @php
                                        App\Http\Controllers\Controller::quote_status();
                                    @endphp
                                </select>
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
    @endforeach

    @foreach ($quotes as $quote)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $quote->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce devis ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('admin/quote/' . $quote->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="delete" value="true">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
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
