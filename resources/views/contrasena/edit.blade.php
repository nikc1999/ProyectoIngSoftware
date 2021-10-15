@extends('layouts.app')
@section('content')

<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" method="POST" action="{{ route('contrasena.update', [$user]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="col-md-6">
                <label class="form-control-label">Nueva Contraseña</label>
                <input id="contrasena" type="text" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" required>
                @error('contrasena')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">{{ __('Cambiar') }}</button>

        </div>
    </form></center>
</div>
@endsection
