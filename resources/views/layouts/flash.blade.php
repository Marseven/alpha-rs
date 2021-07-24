@push('styles')
<style>
    .alert.alert-custom.alert-notice{
        position: absolute;
        top: 85px;
        right: 25px;
    }
</style>
@endpush

@if ($message = Session::get('success'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-succes alert-dismissible fade show" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('warning'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('info'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-info alert-dismissible fade show" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($errors->any())
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">Une erreur s'est produite.</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif
