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
                        <h4>Villes</h4>
                        <span>Gestion des Destinations</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Villes</a></li>
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
                            <h4 class="card-title">Liste des Villes</h4>
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
                                            <th>Pays</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($towns as $town)
                                            <tr>
                                                <td>
                                                    <div class="media d-flex align-items-center">
                                                        <div class="avatar avatar-xl mr-2">
                                                            <img class="rounded-circle img-fluid"
                                                                src="{{ asset($town->picture) }}" alt=""
                                                                width="30">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $town->label }}</td>
                                                <td>{{ $town->code }}</td>
                                                <td>{{ $town->country->label }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($town->status);
                                                @endphp
                                                <td><span
                                                        class="badge-rounded badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#cardModalView{{ $town->id }}"><i
                                                            class="fa fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModal{{ $town->id }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModalCenter{{ $town->id }}">
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
                                            <th>Pays</th>
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

    @foreach ($towns as $town)
        <div class="modal fade" id="cardModalView{{ $town->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $town->label }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="profile-photo">
                                <img src="{{ asset($town->picture) }}" width="100" class="img-fluid rounded-circle"
                                    alt="">
                            </div>
                            <p>{{ $town->country->label }}</p>
                            @php
                                $status = App\Http\Controllers\Controller::status($town->status);
                            @endphp
                            <a class="btn btn-outline-{{ $status['type'] }} btn-rounded mt-3 px-5"
                                href="javascript:void(0)">{{ $status['message'] }}</a>
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer une ville</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/town') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="price" class="col-form-label">Pays</label>
                            <select class="form-control" name="country_id">
                                <option value="">Choisir...</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="picture">
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

    @foreach ($towns as $town)
        <div class="modal fade" id="cardModal{{ $town->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Modifier une ville</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/town/' . $town->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="label" class="col-form-label">Libellé</label>
                                <input type="text" value="{{ $town->label }}" class="form-control" name="label">
                            </div>

                            <div class="mb-3">
                                <label for="code" class="col-form-label">Code</label>
                                <input type="text" value="{{ $town->code }}" class="form-control" name="code">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="col-form-label">Pays</label>
                                <select class="form-control" name="country_id">
                                    <option value="">Choisir...</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="flag" class="col-form-label">Image</label>
                                <input type="file" class="form-control" name="picture">
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

    @foreach ($towns as $town)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $town->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cette ville ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('admin/town/' . $town->id) }}" method="POST">
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
