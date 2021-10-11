@extends('layouts.app')

@section('content')

<div>
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
                <label class="form-control-label">Nuevo nombre:</label>
                <input id="nombre" type="text" class="form-control" name="nombre" required>
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">{{ __('Editar') }}</button>
        </div>
    </form>
</div>

@endsection
