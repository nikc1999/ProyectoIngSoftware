@extends('layouts.app')
@section('content')

<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" method="POST" action="{{ route('contrasena.update', [$user]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="col-md-2">
                <label class="form-control-label">Nueva Contraseña</label>
                <input id="contrasena" type="text" class="form-control" name="contrasena" required>
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">{{ __('Cambiar') }}</button>

        </div>
    </form></center>
</div>
@endsection
