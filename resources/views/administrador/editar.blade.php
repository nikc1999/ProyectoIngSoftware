@extends('layouts.app')

@section('content')

<div>
    <form id="formulario" method="POST" action="{{ route('aplicareditarcarrera', [$carrera]) }}">
        @csrf
        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre Carrera</label>

            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>

            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id = "boton" type="submit" class="btn btn-primary">
                     Editar
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
