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
                        <h4>Pays</h4>
                        <span>Gestion des Destinations</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Pays</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Liste des Pays</h4>
                            <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                                data-target="#securityModal">Ajouter</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Libellé</th>
                                            <th>Code</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($countries as $country)
                                            <tr>
                                                <td>
                                                    <div class="media d-flex align-items-center">
                                                        <div class="avatar avatar-xl mr-2">
                                                            <img class="rounded-circle img-fluid"
                                                                src="{{ asset($country->flag) }}" alt="" width="30">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $country->label }}</td>
                                                <td>{{ $country->code }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($country->status);
                                                @endphp
                                                <td>{{ $status }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#cardModalView{{ $country->id }}"><i
                                                            class="fa fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModal{{ $country->id }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModalCenter{{ $country->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Libellé</th>
                                            <th>Code</th>
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

    @foreach ($countries as $country)
        <div class="modal fade" id="cardModalView{{ $country->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $country->label }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="profile-photo">
                                <img src="{{ $country->flag }}" width="100" class="img-fluid rounded-circle" alt="">
                            </div>
                            <p>{{ $country->code }}</p>
                            @php
                                $status = App\Http\Controllers\Controller::status($country->status);
                            @endphp
                            <a class="btn btn-outline-primary btn-rounded mt-3 px-5"
                                href="javascript:void(0)">{{ $status }}</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="securityModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un pays</h5>
                </div>
                <form action="{{ url('admin/country') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="label" class="col-form-label">Libellé</label>
                            <input type="text" class="form-control" name="label">
                        </div>

                        <div class="mb-3">
                            <label for="code" class="col-form-label">Code</label>
                            <input type="text" class="form-control" name="code">
                        </div>

                        <div class="mb-3">
                            <label for="flag" class="col-form-label">Drapeau</label>
                            <input type="file" class="form-control" name="flag">
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

    @foreach ($countries as $country)
        <div class="modal fade" id="cardModal{{ $country->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Modifier un country</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/country/' . $country->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="label" class="col-form-label">Libellé</label>
                                <input type="text" class="form-control" name="label">
                            </div>

                            <div class="mb-3">
                                <label for="code" class="col-form-label">Code</label>
                                <input type="text" class="form-control" name="code">
                            </div>

                            <div class="mb-3">
                                <label for="flag" class="col-form-label">Drapeau</label>
                                <input type="file" class="form-control" name="flag">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Activé ?</label>
                                <select id="selectOne" name="status" class="form-control">
                                    @php
                                        App\Http\Controllers\Controller::enable_status();
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

    @foreach ($countries as $country)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $country->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce pays ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('admin/country/' . $country->id) }}" method="POST">
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
