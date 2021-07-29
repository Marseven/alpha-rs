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
                    <h4>Hôpital</h4>
                    <span>Gestion des hôpitaux</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Hôpitaux</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des hôpitaux</h4>
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#securityModal">Ajouter</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Pays</th>
                                        <th>Ville</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($hospitals as $hospital)
                                        <tr>
                                            <td>
                                                <div class="media d-flex align-items-center">
                                                    <div class="avatar avatar-xl mr-2">
                                                        <img class="rounded-circle img-fluid" src="{{asset($hospital->picture_1)}}" alt="" width="30">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$hospital->label}}</td>
                                            <td>{{$hospital->country->label}}</td>
                                            <td>{{$hospital->town->label}}</td>
                                            @php
                                                $status = App\Http\Controllers\Controller::status($hospital->status);
                                            @endphp
                                            <td>{{  $status }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#sickModalView{{$hospital->id}}" ><i class="fa fa-medkit"></i></button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cardModalView{{$hospital->id}}" ><i class="fa fa-eye"></i></button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModal{{$hospital->id}}" ><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModalCenter{{$hospital->id}}">
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
                                        <th>Pays</th>
                                        <th>Ville</th>
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

@foreach ( $hospitals as $hospital )

<div class="modal fade" id="cardModalView{{$hospital->id}}" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{$hospital->label}}</h5>
        </div>
        <div class="modal-body">
            <div class="text-center">
                <div class="profile-photo">
                    <img src="{{asset($hospital->picture_1)}}" width="100" class="img-fluid rounded-circle" alt="">
                </div>
                <p class="text-muted">{{$hospital->description}}</p>
                @php
                    $status = App\Http\Controllers\Controller::status($hospital->status);
                @endphp
                <a class="btn btn-outline-primary btn-rounded mt-3 px-5" href="javascript:void(0)">{{$status}}</a>
                <div class="row">
                    <div class="col-6 pt-3 pb-3 border-right">
                        <h3 class="mb-1">{{$hospital->country->label}}</h3><span>Pays</span>
                    </div>
                    <div class="col-6 pt-3 pb-3 border-right">
                        <h3 class="mb-1">{{$hospital->town->label}}</h3><span>Ville</span>
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
          <h5 class="modal-title" id="exampleModalLabelOne">Créer un hôpital</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/hospital') }}" method="POST" enctype="multipart/form-data">
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
                <label for="price" class="col-form-label">Ville</label>
                <select class="form-control" name="town_id">
                    <option value="">Choisir...</option>
                    @foreach ($towns as $town)
                        <option value="{{$town->id}}">{{$town->label}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="picture" class="col-form-label">Image 1</label>
                <input type="file" class="form-control" name="picture_1">
            </div>

            <div class="mb-3">
                <label for="picture" class="col-form-label">Image 2</label>
                <input type="file" class="form-control" name="picture_2">
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

@foreach ( $hospitals as $hospital )
<div class="modal fade" id="cardModal{{$hospital->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">Modifier un hospital</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/hospital/'.$hospital->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="mb-3">
            <label for="name" class="col-form-label">Libellé</label>
            <input type="text" class="form-control" name="label" value="{{$hospital->label}}">
            </div>

            <div class="mb-3">
                <label for="name" class="col-form-label">Description</label>
                <textarea class="form-control" name="description">{{$hospital->description}}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="col-form-label">Ville</label>
                <select class="form-control" name="town_id">
                    <option value="">Choisir...</option>
                    @foreach ($towns as $town)
                        <option value="{{$town->id}}">{{$town->label}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="picture" class="col-form-label">Image 1</label>
                <input type="file" class="form-control" name="picture">
            </div>

            <div class="mb-3">
                <label for="picture" class="col-form-label">Image 2</label>
                <input type="file" class="form-control" name="picture">
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

@foreach ( $hospitals as $hospital )
<div class="modal fade" id="sickModalView{{$hospital->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">
              Maladies Traitées
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sickModal{{$hospital->id}}" ><i class="fa fa-edit"></i></button>
          </h5>
        </div>
        <div class="modal-body">
            <form action="{{ url('admin/hospital-sick/'.$hospital->id) }}" method="POST">
                @csrf
            <div class="table-responsive mb-3">
                <table class="table text-nowrap">
                  <thead class="table-light">
                    <tr>
                      <th class="w-75">Maladies Traitées</th>
                      <th><i class="fa fa-check"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sicks as $sick)
                        @foreach ($hospital->sicks as $hs)
                            @if ($hs->id == $sick->id)
                                <tr>
                                    <td class="border-top-0">
                                        {{$sick->label}}
                                    </td>
                                    <td class="border-top-0">
                                        <div class="form-check ">
                                        <input type="checkbox" checked  name="{{$sick->label}}" class="form-check-input" id="customCheckOne" disabled>
                                        <label class="form-check-label" for="customCheckOne"></label>
                                        </div>
                                    </td>
                                    <input type="hidden" name="hospital"  value="{{$hospital->id}}">
                                    <input type="hidden" name="{{$sick->label}}-sick"  value="{{$sick->id}}">
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                  </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endforeach


@foreach ( $hospitals as $hospital )
<div class="modal fade" id="sickModal{{$hospital->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">Maladies Traitées</h5>
        </div>
        <div class="modal-body">
            <form action="{{ url('admin/hospital-sick/'.$hospital->id) }}" method="POST">
                @csrf
            <div class="table-responsive mb-3">
                <table class="table text-nowrap">
                  <thead class="table-light">
                    <tr>
                      <th class="w-75">Maladies Traitées</th>
                      <th><i class="fa fa-check"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sicks as $sick)
                        <tr>
                            <td class="border-top-0">
                                {{$sick->label}}
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox"  name="sick-{{$sick->id}}" class="form-check-input" id="customCheckOne">
                                <label class="form-check-label" for="customCheckOne"></label>
                                </div>
                            </td>
                            <input type="hidden" name="hospital"  value="{{$hospital->id}}">
                            <input type="hidden" name="{{$sick->id}}-sick"  value="{{$sick->id}}">
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($hospitals as $hospital)
<!-- Modal -->
<div class="modal fade" id="cardModalCenter{{$hospital->id}}" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer cet hôpital ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
          <form action="{{url('admin/hospital/'.$hospital->id)}}" method="POST">
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
