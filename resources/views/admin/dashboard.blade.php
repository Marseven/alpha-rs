@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
                <div class="mr-auto d-none d-lg-block">
                    <h3 class="text-primary font-w600">Bienvenu sur Alpha !</h3>
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
                                    <h4 class="card-title">Dossiers Médicaux</h4>
                                </div>
                                <div class="card-body pt-2">
                                    <h4 class="text-dark font-w400">Total de dossiers</h4>
                                    <h3 class="text-primary font-w600">{{ $folders }} dossiers</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <h4 class="card-title">Demande de devis</h4>
                                    <div class="dropdown ml-auto">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24">
                                                    </rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2">
                                                    </circle>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table class="table patient-activity">

                                            @foreach ($quotes as $quote)
                                                @php
                                                    $quote->load(['country', 'service']);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="media align-items-center">
                                                            <img class="mr-3 img-fluid rounded" width="78"
                                                                src="{{ asset('images/LogoA.png') }}" alt="Quote">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h5 class="mt-0 mb-1">
                                                                        {{ $quote->firstname . ' ' . $quote->lastname }}
                                                                    </h5>
                                                                </a>
                                                                <p class="mb-0">{{ $quote->birthday }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">{{ $quote->country->label }}</p>
                                                        <h5 class="my-0 text-primary">{{ $quote->service->label }}</h5>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <p class="mb-1">Status</p>
                                                                @php
                                                                    $status = App\Http\Controllers\Controller::status($quote->status);
                                                                @endphp
                                                                <h5 class="mt-0 mb-1 text-success">{{ $status['message'] }}
                                                                </h5>
                                                                <small>{{ $quote->created_at }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer border-0 pt-0 text-center">
                                    <a href="{{ url('admin/list-quotes') }}" class="btn-link">Voir Plus >></a>
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
                                            <h3 class="text-white">{{ $countries }}</h3>
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
                                            <h3 class="text-white">{{ $hospitals }}</h3>
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
                                            <h3 class="text-white">{{ $folders }}</h3>
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
                                            <h3 class="text-white">{{ $users }}</h3>
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
                                </div>
                                <div class="card-body pt-2">
                                    <h3 class="text-primary font-w600">{{ $payment_pay }} FCFA <small
                                            class="text-dark ml-2">{{ $payment_total }} FCFA</small></h3>
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

@push('scripts')
    <script>
        var chartBar = function() {

            var options = {
                series: [{
                    name: 'C.A',
                    data: [44, 55, 90, 80, 25, 15, 70, 55, 35],
                    //radius: 12,
                }],
                chart: {
                    type: 'bar',
                    height: 350,

                    toolbar: {
                        show: false,
                    },

                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#450b5a'],
                dataLabels: {
                    enabled: false,
                },
                markers: {
                    shape: "circle",
                },


                legend: {
                    show: true,
                    fontSize: '12px',
                    labels: {
                        colors: '#000000',

                    },
                    markers: {
                        width: 18,
                        height: 18,
                        strokeWidth: 0,
                        strokeColor: '#fff',
                        fillColors: undefined,
                        radius: 12,
                    }
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['transparent']
                },
                grid: {
                    borderColor: '#eee',
                },
                xaxis: {

                    categories: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jui', 'Aou', 'Sept'],
                    labels: {
                        style: {
                            colors: '#787878',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                            fontWeight: 100,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                    crosshairs: {
                        show: false,
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#787878',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                            fontWeight: 100,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " FCFA"
                        }
                    }
                }
            };

            var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
            chartBar1.render();
        }
    </script>
@endpush
