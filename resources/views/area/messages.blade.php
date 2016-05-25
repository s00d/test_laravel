@if (Session::has('error'))
    <div class="alert alert-danger">
        <button type="button" class="close">&times;</button>
        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
        {{ Session::get('error') }}
    </div>
@endif
@foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        <button type="button" class="close">&times;</button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {{ $error }}
    </div>
@endforeach
@if (Session::has('success'))
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close">&times;</button>
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        {{ Session::get('success') }}
    </div>
@endif