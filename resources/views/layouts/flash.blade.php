@if ($message = Session::get('success'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-success fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($message = Session::get('error'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-danger fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($message = Session::get('warning'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-warning fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($message = Session::get('info'))
<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-info fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())

<div style="position: absolute; top: 85px; right: 25px;" class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
