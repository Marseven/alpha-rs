@if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text text-center">{{ $message }}</div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text text-center">{{ $message }}</div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text text-center">{{ $message }}</div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info " role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text text-center">{{ $message }}</div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger " role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        @foreach ($errors->all() as $error)
            <div class="alert-text text-center">{{ $error }}</div>
        @endforeach
    </div>
@endif
