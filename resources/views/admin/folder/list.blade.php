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
                        <h4>Dossiers Médicaux</h4>
                        <span>Gestion des Dossiers Médicaux</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Dossiers Médicaux</a></li>
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
                            <h4 class="card-title">Liste des Dossiers Médicaux</h4>
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

                                        @foreach ($folders as $folder)
                                            <tr>
                                                <td>{{ $folder->id }}</td>
                                                <td>{{ $folder->lastname . ' ' . $folder->firstname }}</td>
                                                <td>{{ $folder->birthday }}</td>
                                                <td>{{ $folder->gender }}</td>
                                                <td>{{ $folder->phone }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($folder->status);
                                                @endphp
                                                <td><span
                                                        class="badge-rounded badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ $folder->join_piece }}"><button type="button"
                                                            class="btn btn-info"><i class="fa fa-download"></i></button></a>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#cardModalView{{ $folder->id }}"><i
                                                            class="fa fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModal{{ $folder->id }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModalCenter{{ $folder->id }}"><i
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

    @foreach ($folders as $folder)
        <div class="modal fade" id="cardModalView{{ $folder->id }}">
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
                            <div class="col-6">
                                <h6 class="text-uppercase fs-5 ls-2">Catégorie</h6>
                                <p class="mb-0">{{ $folder->category }}</p>
                            </div>
                            <div class="col-6">
                                <h6 class="text-uppercase fs-5 ls-2">Service
                                </h6>
                                <p class="mb-0">{{ $folder->service->label }}</p>
                            </div>
                            <div class="col-6">
                                <h6 class="text-uppercase fs-5 ls-2">Pays
                                </h6>
                                <p class="mb-0">{{ $folder->country->label }}</p>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h6 class="text-uppercase fs-5 ls-2">Pièce Jointe</h6>
                                <a href="{{ $folder->join_piece }}">Download</a>
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

    @foreach ($folders as $folder)
        <div class="modal fade" id="cardModal{{ $folder->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Modifier un Dossier</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/folder-state/' . $folder->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Prix de l'évacuation</label>
                                <input type="number" name="price" class="form-control" value="{{ $folder->price }}" />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Statut</label>
                                <select id="selectOne" name="status" class="form-control">
                                    @php
                                        App\Http\Controllers\Controller::work_status();
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

    @foreach ($folders as $folder)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $folder->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce dossier ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('admin/folder/' . $folder->id) }}" method="POST">
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
