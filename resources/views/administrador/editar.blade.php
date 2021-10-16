@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" method="POST" action="{{ route('carrera.update', [$carrera]) }}">
        @csrf
        @method('PUT')
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
            <button type="submit" class="btn btn-outline-primary">{{ __('Editar') }}</button>
        </div>
    </form></center>
</div>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
