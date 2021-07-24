@extends('layouts.default')

@push('styles')
    <link href="{{ asset('css/pages/wizard/wizard-2.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h2 class="text-white font-weight-bold my-2 mr-5">Recharge de Carte Prépayée </h2>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <div class="d-flex align-items-center font-weight-bold my-2">
                    <!--begin::Item-->
                    <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                        <i class="flaticon2-shelter text-white icon-1x"></i>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Recharge de Carte Prépayée</a>
                    <!--end::Item-->
                </div>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom">
            <div class="card-body p-0">
                <!--begin: Wizard-->
                <div class="wizard wizard-2" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
                    <!--begin: Wizard Nav-->
                    <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                        <!--begin::Wizard Step 1 Nav-->
                        <div class="wizard-steps">
                            <!--begin::Wizard Step 5 Nav-->
                            <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <span class="svg-icon svg-icon-2x">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Credit-card.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14" rx="2" />
                                                    <rect fill="#000000" x="2" y="8" width="20" height="3" />
                                                    <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">La Carte Prépayée</h3>
                                        <div class="wizard-desc">Visa Orabank</div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Wizard Step 5 Nav-->
                            <!--begin::Wizard Step 6 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <span class="svg-icon svg-icon-2x">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Like.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z" fill="#000000" />
                                                    <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">Terminé !</h3>
                                        <div class="wizard-desc">Soumettre la recharge</div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Wizard Step 6 Nav-->
                        </div>
                    </div>
                    <!--end: Wizard Nav-->
                    <!--begin: Wizard Body-->
                    <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                        <!--begin: Wizard Form-->
                        <div class="row">
                            <div class="offset-xxl-2 col-xxl-8">
                                <form class="form" id="kt_form" method="POST" action="{{ url('/refill') }}">
                                    @csrf
                                    <!--begin: Wizard Step 5-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <h4 class="mb-10 font-weight-bold text-dark">Informations de la Carte Prépayée</h4>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Nom de la Carte</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="name_card" placeholder="Card Name" value="John Wick" />
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Numéro de la Carte</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="number_card" placeholder="Card Number" value="4444 3333 2222 1111" />
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Mois d'expiration</label>
                                                    <input type="number" class="form-control form-control-solid form-control-lg" name="month_card" placeholder="Card Expiry Month" value="01" />
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Année d'expiration</label>
                                                    <input type="number" class="form-control form-control-solid form-control-lg" name="year_card" placeholder="Card Expire Year" value="2021" />
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>CVV de la Carte</label>
                                                    <input type="password" class="form-control form-control-solid form-control-lg" name="cvv_card" placeholder="Card CVV Number" value="123" />
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 5-->
                                    <!--begin: Wizard Step 6-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <!--begin::Section-->
                                        <h4 class="mb-10 font-weight-bold text-dark">Soumettre la recharge</h4>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Montant de la recharge</label>
                                                    <input type="number" class="form-control form-control-solid form-control-lg" name="amount_refill" placeholder="30000" value="30000" required/>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Pièce d'identité</label>
                                                    <input type="file" class="form-control form-control-solid form-control-lg" name="card_id" />
                                                    <span class="form-text text-muted">Veuillez renseigner ce champ si le montant de votre recharge est supérieur à 1 000 000 XAF.</span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="separator separator-dashed my-5"></div>
                                        <!--end::Section-->
                                        <!--begin::Section-->

                                        <div class="text-dark-50 line-height-lg">
                                            <div class="form-group">
                                                <label class="checkbox mb-0">
                                                <input type="checkbox" name="agree" />
                                                <a href="#"> J'accepte les termes & conditions </a>.
                                                 <span style="margin: 10px;"></span> </label>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end: Wizard Step 6-->
                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Précédent</button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Payer</button>
                                            <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Suivant</button>
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                </form>
                            </div>
                            <!--end: Wizard-->
                        </div>
                        <!--end: Wizard Form-->
                    </div>
                    <!--end: Wizard Body-->
                </div>
                <!--end: Wizard-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection

@push('scripts')
    <script src="{{ asset('js/pages/custom/wizard/wizard-2.js')}}"></script>
@endpush
