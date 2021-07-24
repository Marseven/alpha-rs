@extends('layouts.default')

@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!-- begin::Card-->
            <div class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">PAIMENT DE RECHARGE  ###{{$refill->id}}</h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <!--begin::Logo-->
                                    <a href="#" class="mb-5">
                                        <img src="assets/media/logos/logo-dark.png" alt="" />
                                    </a>
                                    <!--end::Logo-->
                                    <span class="d-flex flex-column align-items-md-end opacity-70">
                                        <span>{{$user->name}}</span>
                                        <span>{{$user->email}}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">DATE</span>
                                    <span class="opacity-70">{{$refill->created_at}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">REFERENCE NO.</span>
                                    <span class="opacity-70">{{$refill->reference}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">CARTE PREPAYEE.</span>
                                    <span class="opacity-70">{{$refill->number_card}}
                                    <br />{{$refill->expired_card}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Description</th>
                                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-boldest">
                                            <td class="pl-0 pt-7">{{$refill->payment[0]->description}}</td>
                                            <td class="text-danger pr-0 pt-7 text-right">{{$refill->amount_refill}} XAF</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold text-muted text-uppercase">OPERATEUR</th>
                                            <th class="font-weight-bold text-muted text-uppercase">NO. TRANSACTION</th>
                                            <th class="font-weight-bold text-muted text-uppercase">DATE DE PAIEMENT</th>
                                            <th class="font-weight-bold text-muted text-uppercase">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-bolder">
                                            <td>{{$refill->payment[0]->operator}}</td>
                                            <td>{{$refill->payment[0]->transaction_id}}</td>
                                            <td>{{$refill->payment[0]->paid_at}}</td>
                                            <td class="text-danger font-size-h3 font-weight-boldest">{{$refill->payment[0]->amount}} XAF</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Imprimer</button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!-- end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
