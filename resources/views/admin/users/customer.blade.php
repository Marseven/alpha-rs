@extends('layouts.admin')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<!-- Container fluid -->
<div class="container-fluid px-6 py-4">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
        <div>
          <div class="border-bottom pb-4">
            <div class="mb-2 mb-lg-0">
              <h3 class="mb-0 fw-bold">Gestions des utilisateurs</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="py-6">
      <!-- table -->
      <div class="row mb-6">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div id="examples" class="mb-4">
            <h2>Liste des clients</h2>
          </div>
          <!-- Card -->
          <div class="card">
            <!-- Tab content -->
            <div class="tab-content p-4" id="pills-tabContent-table">
              <div class="tab-pane tab-example-design fade show
                active" id="pills-table-design" role="tabpanel"
                aria-labelledby="pills-table-design-tab">
                <!-- Basic table -->
                <div class="table-responsive">
                <table class="table">
                  <thead >
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->security_role->name}}</td>
                            <td>{{$user->security_object->enable}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cardModal" >Modifer</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cardModalCenter">
                                   Supprimer
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
                <!-- Basic table -->
              </div>
            </div>
           </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin-card') }}" method="POST">
              @csrf
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Statut</label>
              <select id="selectOne" class="form-control">
                <option>En Cours</option>
                <option>Terminé</option>
                <option>En Attente</option>
                <option>Annulé</option>
                <option>Refusé</option>
             </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
        </form>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer cet utilisateur ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
          <button type="button" class="btn btn-danger">Supprimer</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!--end::Page Vendors-->

    <script type="script">
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>

@endpush
