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
            @include('layouts.flash-admin')
            <br>
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
                                            <th>Valeur</th>
                                            <th>Pathalogie</th>
                                            <th>Service</th>
                                            <th>Pays</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($simulators as $simulator)
                                            <tr>
                                                <td>
                                                    {{ $simulator->id }}
                                                </td>
                                                <td>{{ $simulator->item->label }}</td>
                                                <td>{{ $simulator->value }}</td>
                                                <td>{{ $simulator->sick->label }}</td>
                                                <td>{{ $simulator->service->label }}</td>
                                                <td>{{ $simulator->country->label }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($simulator->status);
                                                @endphp
                                                <td><span
                                                        class="badge-rounded badge-{{ $status['type'] }}">{{ $status['message'] }}</span>
                                                </td>
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
                                            <th>Valeur</th>
                                            <th>Pathalogie</th>
                                            <th>Service</th>
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

    @foreach ($simulators as $simulator)
        @php
            $simulator->load(['country', 'service']);
        @endphp

        <div class="modal fade" id="cardModalView{{ $simulator->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $simulator->id }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">

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
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer une valeur</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/simulator') }}" method="POST">
                        @csrf
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
                            <label for="sick" class="col-form-label">Pathologie</label>
                            <select id="selectOne" name="sick_id" class="form-control">
                                @foreach ($sicks as $sick)
                                    <option value="{{ $sick->id }}">{{ $sick->label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="item_id" class="col-form-label">Élément</label>
                            <select id="selectOne" name="item_id" class="form-control">
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="value" class="col-form-label">Valeur</label>
                            <input type="text" class="form-control" name="value">
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
                                <label for="country" class="col-form-label">Pays</label>
                                <select id="selectOne" name="country_id" class="form-control">
                                    <option value="{{ $simulator->country_id }}">{{ $simulator->country->label }}
                                    </option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="service" class="col-form-label">Service</label>
                                <select id="selectOne" name="service_id" class="form-control">
                                    <option value="{{ $simulator->service_id }}">{{ $simulator->service->label }}
                                    </option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="sick" class="col-form-label">Pathologie</label>
                                <select id="selectOne" name="sick_id" class="form-control">
                                    <option value="{{ $simulator->sick_id }}">{{ $simulator->sick->label }}</option>
                                    @foreach ($sicks as $sick)
                                        <option value="{{ $sick->id }}">{{ $sick->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="item_id" class="col-form-label">Élément</label>
                                <select id="selectOne" name="item_id" class="form-control">
                                    <option value="{{ $simulator->simulator_item_id }}">{{ $simulator->item->label }}
                                    </option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->label }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="value" class="col-form-label">Valeur</label>
                                <input type="text" class="form-control" name="value"
                                    value="{{ $simulator->value }}">
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
