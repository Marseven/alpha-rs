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
                        <h4>Eléments du Simulateur</h4>
                        <span>Simulateur</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Simulateur</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Liste des éléments</h4>
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
                                            <th>Prix Min</th>
                                            <th>Prix Max</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($simulators as $simulator)
                                            <tr>
                                                <td>
                                                    <div class="media d-flex align-items-center">
                                                        <div class="avatar avatar-xl mr-2">
                                                            <img class="rounded-circle img-fluid"
                                                                src="{{ asset($simulator->picture) }}" alt="" width="30">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $simulator->label }}</td>
                                                <td>{{ $simulator->price_min }}</td>
                                                <td>{{ $simulator->price_max }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($simulator->status);
                                                @endphp
                                                <td>{{ $status }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#cardModalView{{ $simulator->id }}"><i
                                                            class="fa fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModal{{ $simulator->id }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModalCenter{{ $simulator->id }}">
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
                                            <th>Prix Min</th>
                                            <th>Prix Max</th>
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

    @foreach ($simulators as $simulator)

        <div class="modal fade" id="cardModalView{{ $simulator->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $simulator->label }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-4 pt-3 pb-3 border-right">
                                    <h3 class="mb-1">{{ $simulator->price_min }} / {{ $simulator->periode }}
                                    </h3><span>Prix Min</span>
                                </div>
                                <div class="col-4 pt-3 pb-3 border-right">
                                    <h3 class="mb-1">{{ $simulator->price_max }} / {{ $simulator->periode }}
                                    </h3><span>Prix Max</span>
                                </div>
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


    <div class="modal fade" id="securityModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un simulateur</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/simulator') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Libellé</label>
                            <input type="text" class="form-control" name="label">
                        </div>

                        <div class="mb-3">
                            <label for="price_min" class="col-form-label">Prix Min</label>
                            <input type="text" class="form-control" name="price_min">
                        </div>

                        <div class="mb-3">
                            <label for="price_max" class="col-form-label">Prix Max</label>
                            <input type="text" class="form-control" name="price_max">
                        </div>

                        <div class="mb-3">
                            <label for="price_max" class="col-form-label">Periode</label>
                            <select id="selectOne" name="periode" class="form-control">
                                <option value="Jour">Jour</option>
                                <option value="Mois">Mois</option>
                                <option value="Année">Année</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="col-form-label">Pays</label>
                            <select id="selectOne" name="country_id" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="service" class="col-form-label">Service</label>
                            <select id="selectOne" name="service_id" class="form-control">
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->label }}</option>
                                @endforeach
                            </select>
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

    @foreach ($simulators as $simulator)
        <div class="modal fade" id="cardModal{{ $simulator->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Modifier un simulateur</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/simulator/' . $simulator->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Libellé</label>
                                <input type="text" class="form-control" name="label" value="{{ $simulator->label }}">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="col-form-label">Prix Min</label>
                                <input type="text" class="form-control" name="price_min"
                                    value="{{ $simulator->price_min }}">
                            </div>

                            <div class="mb-3">
                                <label for="price_promo" class="col-form-label">Prix Max</label>
                                <input type="text" class="form-control" name="price_max"
                                    value="{{ $simulator->price_max }}">
                            </div>

                            <div class="mb-3">
                                <label for="price_max" class="col-form-label">Periode</label>
                                <select id="selectOne" name="periode" class="form-control">
                                    <option value="{{ $simulator->periode }}">{{ $simulator->periode }}</option>
                                    <option value="Jour">Jour</option>
                                    <option value="Mois">Mois</option>
                                    <option value="Année">Année</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="country" class="col-form-label">Pays</label>
                                <select id="selectOne" name="country_id" class="form-control">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="service" class="col-form-label">Service</label>
                                <select id="selectOne" name="service_id" class="form-control">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->label }}</option>
                                    @endforeach
                                </select>
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

    @foreach ($simulators as $simulator)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $simulator->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce simulateur ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('admin/simulator/' . $simulator->id) }}" method="POST">
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
