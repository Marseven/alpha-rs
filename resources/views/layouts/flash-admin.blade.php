
@if ($message = Session::get('success'))
<div  class="alert alert-succes" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div  class="alert alert-danger" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('warning'))
<div  class="alert alert-warning" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('info'))
<div  class="alert alert-info " role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($errors->any())

<div  class="alert alert-danger " role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">Une erreur s'est produite.</div>
    <div class="alert-close">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
</div>
@endif
