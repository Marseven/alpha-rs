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
                        <h4>Paiements</h4>
                        <span>Gestion des Dossiers Médicaux</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Paiements</a></li>
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
                            <h4 class="card-title">Liste des Paiements</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reference</th>
                                            <th>N° Produit</th>
                                            <th>Montant</th>
                                            <th>ID Transaction</th>
                                            <th>Opérateur</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->reference }}</td>
                                                <td>{{ $payment->refill->number_card ?? 'ACHAT' }}</td>
                                                <td>{{ $payment->amount }} XAF</td>
                                                <td>{{ $payment->transaction_id }}</td>
                                                <td>{{ $payment->operator }}</td>
                                                @php
                                                    $status = App\Http\Controllers\Controller::status($payment->status);
                                                @endphp
                                                <td>{{ $status }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Reference</th>
                                            <th>N° Produit</th>
                                            <th>Montant</th>
                                            <th>ID Transaction</th>
                                            <th>Opérateur</th>
                                            <th>Statut</th>
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
@endsection

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins-init/datatables.init.js') }}"></script>
@endpush
