@extends('layouts.admin')

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
            <div class="mr-auto d-none d-lg-block">
                <h3 class="text-primary font-w600">Bienvenu sur  Alpha !</h3>
                <p class="mb-0">Espage de Gestion Administrateur</p>
            </div>

            <div class="input-group search-area ml-auto d-inline-flex">
                <input type="text" class="form-control" placeholder="Recherche">
                <div class="input-group-append">
                    <a href="javascript:void(0)" class="input-group-text"><i class="flaticon-381-search-2"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Dossiers Médicaux (%)</h4>
                                <!--select class="form-control style-1 default-select ">
                                    <option>Semaine</option>
                                    <option>Jour</option>
                                    <option>Mois</option>
                                </select-->
                            </div>
                            <div class="card-body pt-2">
                                <h4 class="text-dark font-w400">Total de dossiers</h4>
                                <h3 class="text-primary font-w600">{{$folders}} dossiers</h3>
                                <div class="row mx-0 align-items-center">
                                    <div class="col-sm-8 col-md-7  px-0">
                                        <div id="chartCircle"></div>
                                    </div>
                                    <div class="col-sm-4 col-md-5 px-0">
                                        <div class="patients-chart-deta">
                                            <div class="col px-0">
                                                <span class="bg-danger"></span>
                                                <div>
                                                    <p>Nouveau</p>
                                                    <h3>{{ $folders_today > 0 ? (($folders-$folders_today)/$folders_today)*100 : 0 }}%</h3>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <span class="bg-success"></span>
                                                <div>
                                                    <p>Traité</p>
                                                    <h3>{{ $folders_end > 0 ? (($folders-$folders_end)/$folders_end)*100 : 0 }}%</h3>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <span class="bg-warning"></span>
                                                <div>
                                                    <p>En Taitement</p>
                                                    <h3>{{ $folders_pending > 0 ? (($folders-$folders_pending)/$folders_pending)*100 : 0 }}%</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Demande de devis</h4>
                                <div class="dropdown ml-auto">
                                    <div class="btn-link" data-toggle="dropdown">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table class="table patient-activity">

                                        @foreach ($quotes as $quote)

                                            @php
                                                $quote->load(['country', 'service'])
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <img class="mr-3 img-fluid rounded" width="78" src="{{asset('images/LogoA.png')}}" alt="Quote">
                                                        <div class="media-body">
                                                            <a href="#"><h5 class="mt-0 mb-1">{{$quote->firstname.' '.$quote->lastname}}</h5></a>
                                                            <p class="mb-0">{{$quote->birthday}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="mb-0">{{$quote->country->label}}</p>
                                                    <h5 class="my-0 text-primary">{{$quote->service->label}}</h5>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-1">Status</p>
                                                            @php
                                                                $status = App\Http\Controllers\Controller::status($quote->status);
                                                            @endphp
                                                            <h5 class="mt-0 mb-1 text-success">{{  $status }}</h5>
                                                            <small>{{$quote->created_at}}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                            </div>
                            <div class="card-footer border-0 pt-0 text-center">
                                <a href="{{url('admin/list-quotes')}}" class="btn-link">Voir Plus >></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-12">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-danger">
                            <div class="card-body  p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Destinations</p>
                                        <h3 class="text-white">{{$countries}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-success">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Hôpitaux</p>
                                        <h3 class="text-white">{{$hospitals}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-info">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-folder"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Dossiers</p>
                                        <h3 class="text-white">{{$folders}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-primary">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-user-7"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Utilisateurs</p>
                                        <h3 class="text-white">{{$users}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Statistique des Paiements</h4>
                                <select class="form-control style-1 default-select ">
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                </select>
                            </div>
                            <div class="card-body pt-2">
                                <h3 class="text-primary font-w600">{{$payment_pay}} XAF <small class="text-dark ml-2">{{$payment_total}} XAF</small></h3>
                                <div id="chartBar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>

@endsection
