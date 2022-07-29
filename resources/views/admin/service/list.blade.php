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
                        <h4>Services</h4>
                        <span>Gestion des Services</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Services</a></li>
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
                            <h4 class="card-title">Liste des Services</h4>
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
                                            <th>Description</th>
                                            <th>Prix</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($services as $service)
                                            <tr>
                                                <td>
                                                    <div class="media d-flex align-items-center">
                                                        <div class="avatar avatar-xl mr-2">
                                                            <img class="rounded-circle img-fluid"
                                                                src="{{ asset($service->picture) }}" alt=""
                                                                width="30">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $service->label }}</td>
                                                <td>{{ $service->description }}</td>
                                                <td>{{ $service->price }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($service->status);
                                                @endphp
                                                <td>{{ $status }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#cardModalView{{ $service->id }}"><i
                                                            class="fa fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModal{{ $service->id }}"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#cardModalCenter{{ $service->id }}">
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
                                            <th>Description</th>
                                            <th>Prix</th>
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

    @foreach ($services as $service)
        <div class="modal fade" id="cardModalView{{ $service->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $service->label }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="profile-photo">
                                <img src="{{ asset($service->picture) }}" width="100" class="img-fluid rounded-circle"
                                    alt="">
                            </div>
                            <p class="text-muted">{{ $service->description }}</p>
                            <a class="btn btn-outline-primary btn-rounded mt-3 px-5"
                                href="javascript:void(0)">{{ $service->price }} XAF</a>
                            <div class="row">
                                <div class="col-4 pt-3 pb-3 border-right">
                                    <h3 class="mb-1">{{ $service->price_promo }}</h3><span>Prix Promo</span>
                                </div>
                                <div class="col-4 pt-3 pb-3 border-right">
                                    <h3 class="mb-1">{{ $service->begin_promo }}</h3><span>Début</span>
                                </div>
                                <div class="col-4 pt-3 pb-3">
                                    <h3 class="mb-1">{{ $service->end_promo }}</h3><span>Fin</span>
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un service</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/service') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Libellé</label>
                            <input type="text" class="form-control" name="label">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Description</label>
                            <textarea class="form-control" name="description">Description...</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="col-form-label">Prix</label>
                            <input type="text" class="form-control" name="price">
                        </div>

                        <div class="mb-3">
                            <label for="price_promo" class="col-form-label">Prix de promo</label>
                            <input type="text" class="form-control" name="price_promo">
                        </div>

                        <div class="mb-3">
                            <label for="begin_promo" class="col-form-label">Début de la Promo</label>
                            <input type="date" class="form-control" name="begin_promo">
                        </div>

                        <div class="mb-3">
                            <label for="end_promo" class="col-form-label">Fin de la Promo</label>
                            <input type="date" class="form-control" name="end_promo">
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="col-form-label">Image</label>
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

    @foreach ($services as $service)
        <div class="modal fade" id="cardModal{{ $service->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Modifier un service</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/service/' . $service->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Libellé</label>
                                <input type="text" class="form-control" name="label"
                                    value="{{ $service->label }}">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Description</label>
                                <textarea class="form-control" name="description">{{ $service->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="col-form-label">Prix</label>
                                <input type="text" class="form-control" name="price"
                                    value="{{ $service->price }}">
                            </div>

                            <div class="mb-3">
                                <label for="price_promo" class="col-form-label">Prix de promo</label>
                                <input type="text" class="form-control" name="price_promo"
                                    value="{{ $service->price_promo }}">
                            </div>

                            <div class="mb-3">
                                <label for="begin_promo" class="col-form-label">Début de la Promo</label>
                                <input type="date" class="form-control" name="begin_promo"
                                    value="{{ $service->begin_promo }}">
                            </div>

                            <div class="mb-3">
                                <label for="end_promo" class="col-form-label">Fin de la Promo</label>
                                <input type="date" class="form-control" name="end_promo"
                                    value="{{ $service->end_promo }}">
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="col-form-label">Image</label>
                                <input type="file" class="form-control" name="picture"
                                    value="{{ $service->picture }}">
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

    @foreach ($services as $service)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $service->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce service ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                        <form action="{{ url('admin/service/' . $service->id) }}" method="POST">
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
