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
                    <h4>Rôles</h4>
                    <span>Gestion des Utilisateurs</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Rôles</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des Rôles</h4>
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#securityModal">Ajouter</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Espace</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($roles as $role)

                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->objects[0]->name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cardModalView{{$role->id}}" >Voir</button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModal{{$role->id}}" >Modifer</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cardModalCenter{{$role->id}}">
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
                                        <th>Espace</th>
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


@foreach($roles as $role)
<div class="modal fade" id="cardModalView{{$role->id}}" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">{{$role->name}}</h5>
        </div>
        <div class="modal-body">
            <div class="table-responsive mb-3">
                <table class="table text-nowrap">
                  <thead class="table-light">
                    <tr>
                      <th class="w-75">Permissions du rôle</th>
                      <th><i class="fa fa-eye"></i></th>
                      <th><i class="fa fa-edit"></i></th>
                      <th><i class="fa fa-plus"></i></th>
                      <th><i class="fa fa-trash"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($rolepermissions as $permission)
                        @if ($permission->security_role_id == $role->id)

                        <tr>

                            <td class="border-top-0">
                                {{$permission->name}}
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" {{ $permission->look == "on" ? 'checked' : ''}} disabled class="form-check-input" id="customCheckOne">
                                <label class="form-check-label" for="customCheckOne"></label>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" {{ $permission->creat == "on" ? 'checked' : ''}} disabled class="form-check-input" id="customCheckOne" >
                                <label class="form-check-label" for="customCheckOne"></label>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" {{ $permission->updat == "on" ? 'checked' : ''}} disabled class="form-check-input" id="customCheckTwo">
                                <label class="form-check-label" for="customCheckTwo"></label>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" {{ $permission->del == "on" ? 'checked' : ''}} disabled  class="form-check-input" id="customCheckThree">
                                <label class="form-check-label" for="customCheckThree"></label>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($roles as $role)
<div class="modal fade" id="cardModal{{$role->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">{{$role->name}}</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/security-permission/edit/'.$role->id) }}" method="POST">
              @csrf
            <div class="table-responsive mb-3">
                <table class="table text-nowrap">
                  <thead class="table-light">
                    <tr>
                      <th class="w-75">Permissions du rôle</th>
                      <th><i class="fa fa-eye"></i></th>
                      <th><i class="fa fa-edit"></i></th>
                      <th><i class="fa fa-plus"></i></th>
                      <th><i class="fa fa-trash"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td class="border-top-0">
                                {{$permission->name}}
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" name="{{$permission->name}}-view" class="form-check-input" id="customCheckOne">
                                <label class="form-check-label" for="customCheckOne"></label>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" name="{{$permission->name}}-create" class="form-check-input" id="customCheckOne">
                                <label class="form-check-label" for="customCheckOne"></label>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" name="{{$permission->name}}-edit" class="form-check-input" id="customCheckTwo">
                                <label class="form-check-label" for="customCheckTwo"></label>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="form-check ">
                                <input type="checkbox" name="{{$permission->name}}-delete" class="form-check-input" id="customCheckThree">
                                <label class="form-check-label" for="customCheckThree"></label>
                                </div>
                            </td>
                            <input type="hidden" name="role"  value="{{$role->id}}">
                            <input type="hidden" name="{{$permission->name}}-permission"  value="{{$permission->id}}">

                        </tr>
                    @endforeach
                  </tbody>
                </table>
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

<div class="modal fade" id="securityModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">Créer un rôle</h5>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/security-role') }}" method="POST">
              @csrf
            <div class="mb-3">
              <label for="name" class="col-form-label">Libellé</label>
              <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="security_object_id" class="col-form-label">Espace</label>
                <select id="selectOne" class="form-control" name="security_object_id">
                    @foreach($objects as $object)
                        <option value="{{$object->id}}">{{$object->name}}</option>
                    @endforeach
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

@foreach($roles as $role)
<!-- Modal -->
<div class="modal fade" id="cardModalCenter{{$role->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer ce rôle ?
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
