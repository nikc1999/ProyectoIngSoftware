@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" method="POST" action="{{ route('carrera.update', [$carrera]) }}">
        @csrf
        @method('PUT')
        <br>
        <div class="col-md-2">
            <label>Codigo carrera: </label>
        </div>
        <div class="col-md-2">
            <label>  </label>
            <label>{!! $carrera->codigo !!}</label>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label class="form-control-label @error('nombre') is-invalid @enderror">Nuevo nombre:</label>
                <input id="nombre" type="text" class="form-control" name="nombre" required>
                @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-info">{{ __('Editar') }}</button>
        </div>
        <br>
    </form></center>
</div>

<br>
<br>
<center><a href="/gestionarcarreras"><button class="btn btn-info btn-block" type="button">Volver</button></a></center>
<center><a href="{{ route('home') }}"><button class="btn btn-dark btn-block" type="button">Volver Menu</button></a></center>

@else

@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
