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
                    <h4>Maladies</h4>
                    <span>Gestion des hôpitaux</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Maladies</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des maladies</h4>
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#securityModal">Ajouter</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Description</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($sicks as $sick)
                                        <tr>
                                            <td>
                                                {{$sick->id}}
                                            </td>
                                            <td>
                                                {{$sick->label}}
                                            </td>
                                            <td>{{$sick->description}}</td>
                                            @php
                                                $status = App\Http\Controllers\Controller::status($sick->status);
                                            @endphp
                                            <td>{{  $status }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cardModalView{{$sick->id}}" ><i class="fa fa-eye"></i></button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModal{{$sick->id}}" ><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModalCenter{{$sick->id}}">
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

@foreach ( $sicks as $sick )

<div class="modal fade" id="cardModalView{{$sick->id}}" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{$sick->label}}</h5>
        </div>
        <div class="modal-body">
            <div class="text-center">
                <p class="text-muted">{{$sick->description}}</p>
                @php
                    $status = App\Http\Controllers\Controller::status($sick->status);
                @endphp
                <a class="btn btn-outline-primary btn-rounded mt-3 px-5" href="javascript:void(0)">{{$status}}</a>
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
          <h5 class="modal-title" id="exampleModalLabelOne">Créer une maladie</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/sick') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="mb-3">
              <label for="name" class="col-form-label">Libellé</label>
              <input type="text" class="form-control" name="label">
            </div>

            <div class="mb-3">
                <label for="name" class="col-form-label">Description</label>
                <textarea class="form-control" name="description">Description...</textarea>
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

@foreach ( $sicks as $sick )
<div class="modal fade" id="cardModal{{$sick->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">Modifier une maladie</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/sick/'.$sick->id) }}" method="POST" enctype="multipart/form-data">
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
                <label for="name" class="col-form-label">Activé ?</label>
                <select id="selectOne" name="enable" class="form-control">
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

@foreach($sicks as $sick)
<!-- Modal -->
<div class="modal fade" id="cardModalCenter{{$sick->id}}" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer cette maladie ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
          <form action="{{url('admin/sick/'.$sick->id)}}" method="POST">
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
    <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins-init/datatables.init.js')}}"></script>

@endpush
