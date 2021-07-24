@extends('layouts.admin')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Profil</h4>
                    <p class="mb-0">Espace Administration</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Profil</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="{{asset($user->picture ? $user->picture : '/images/blank.png')}}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{$user->name}}</h4>
                                    <p>{{$user->role ? $user->role->name : "Aucun"}}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{$user->email}}</h4>
                                    <p>Email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-statistics mb-5">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="m-b-0">150</h3><span>Devis</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-b-0">140</h3><span>Dossiers</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-b-0">45</h3><span>Reviews</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link active">Informations Personnelles</a>
                                    </li>
                                    <li class="nav-item"><a href="#password-settings" data-toggle="tab" class="nav-link">Mot de Passe</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="profile-settings" class="tab-pane fade open active show">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <h4 class="text-primary">Mes infos</h4>
                                                <br>
                                                <form method="POST" accept="" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Image de Profil</label>
                                                        <input type="file"  value="" placeholder="074010203" name="picture" class="form-control">
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Nom Complet</label>
                                                            <input type="text" value="{{$user->name}}" placeholder="Nom Complet" name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" value="{{$user->email}}" name="email" placeholder="Email" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Téléphone</label>
                                                        <input type="text"  value="{{$user->phone}}" placeholder="074010203" name="phone" class="form-control">
                                                    </div>

                                                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="password-settings" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <h4 class="text-primary">Réinitialisé le mot de passe</h4>
                                                <br>
                                                <form method="POST" accept="" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label>Mot de passe actuel</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Mot de passe actuel" />
                                                        <a href="#" class="text-sm font-weight-bold">Mot de passe oublié ?</a>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label>Nouveau mot de passe</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Nouveau mot de passe" />
                                                    </div>
                                                    <div class="form-group row">
                                                        <label>Confimer le mot de passe</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Confirmer mot de passe" />

                                                    </div>

                                                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
