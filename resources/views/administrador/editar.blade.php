@extends('layouts.app')

@section('content')

<div>
    <form id="formulario" method="POST" action="{{ route('carrera.update', [$carrera]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-control-label">NOMBRE</label>
            <input value="{{$carrera->nombre}}" id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                name="nombre" required>

            @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-lg-12 py-3">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-outline-primary">{{ __('Editar') }}</button>
            </div>
        </div>
    </form>
</div>

@endsection
