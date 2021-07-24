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
          <div class="border-bottom pb-4 mb-4 d-flex align-items-center
              justify-content-between">
            <div class="mb-2 mb-lg-0">
              <h3 class="mb-0 fw-bold">Ajouter un utilisateur</h3>
            </div>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-8">
      <div class="col-xl-3 col-lg-4 col-md-12 col-12">
        <div class="mb-4 mb-lg-0">
          <h4 class="mb-1">Informations Personnelles</h4>
          <p class="mb-0 fs-5 text-muted">Informations Personnelles de l'utilisateur </p>
        </div>

      </div>

      <div class="col-xl-9 col-lg-8 col-md-12 col-12">
        <!-- card -->
        <div class="card">
          <!-- card body -->
          <div class="card-body">
            <div class=" mb-6">
              <h4 class="mb-1">Informations</h4>

            </div>
            <div class="row align-items-center mb-8">
              <div class="col-md-3 mb-3 mb-md-0">
                <h5 class="mb-0">Photo de profil</h5>
              </div>
              <div class="col-md-9">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <img src="{{asset('media/users/blank.png')}}" class="rounded-circle avatar avatar-lg" alt="">
                  </div>
                  <div>
                    <button type="submit" class="btn btn-outline-white
                        me-1">Changer</button>
                    <button type="submit" class="btn btn-outline-white">Retirer</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- col -->
            <div>
              <!-- border -->
              <div class="mb-6">
                <h4 class="mb-1">Informations</h4>

              </div>
              <form method="POST" action="{{route('register')}}">
                  @csrf
                <!-- row -->

                <div class="mb-3 row">
                  <label for="fullName" class="col-sm-4 col-form-label
                      form-label">Nom complet</label>
                  <div class="col-sm-4 mb-3 mb-lg-0">
                    <input type="text" class="form-control" placeholder="First name" id="name" required>
                  </div>
                </div>

                <!-- row -->
                <div class="mb-3 row">
                  <label for="email" class="col-sm-4 col-form-label
                      form-label">Email</label>
                  <div class="col-md-8 col-12">
                    <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
                  </div>
                </div>

                <!-- row -->
                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label
                        form-label">Rôle</label>
                    <div class="col-md-8 col-12">
                        <select id="selectOne" class="form-control" name="security_role_id">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                         </select>
                    </div>
                  </div>
                <!-- row -->
                  <div class="offset-md-4 col-md-8 mt-4">
                    <button type="submit" class="btn btn-primary"> Enregister</button>
                  </div>
              </form>
            </div>
          </div>
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
