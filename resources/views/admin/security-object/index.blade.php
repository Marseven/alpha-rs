@extends('layouts.admin')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Espaces</h4>
                    <span>Gestion des Utilisateurs</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Espaces</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des Espaces</h4>
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#securityModal">Ajouter</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Url</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($objects as $object)
                                        <tr>
                                            <td>{{$object->id}}</td>
                                            <td>{{$object->name}}</td>
                                            <td>{{$object->url}}</td>
                                            <td>{{$object->icon}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModalCenter{{$object->id}}">
                                                    Supprimer
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Url</th>
                                        <th>Icon</th>
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

<div class="modal fade" id="securityModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">Créer un espace</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/security-object') }}" method="POST">
              @csrf
            <div class="mb-3">
              <label for="name" class="col-form-label">Libellé</label>
              <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="name" class="col-form-label">Url</label>
                <input type="text" class="form-control" name="url">
            </div>

            <div class="mb-3">
                <label for="name" class="col-form-label">Icon</label>
                <input type="text" class="form-control" name="icon">
            </div>

            <div class="mb-3">
                <label for="name" class="col-form-label">Activé ?</label>
                <select id="selectOne" name="enable" class="form-control">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
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

@foreach($objects as $object)
<!-- Modal -->
<div class="modal fade" id="cardModalCenter{{$object->id}}" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer cet espace ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
          <button type="button" class="btn btn-danger">Supprimer</button>
        </div>
      </div>
    </div>
  </div>
@endforeach


@endsection

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins-init/datatables.init.js')}}"></script>

@endpush
