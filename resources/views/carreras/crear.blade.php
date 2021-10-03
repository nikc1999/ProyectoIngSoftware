@extends('layouts.app')

@section('content')

<div>
    <form method="POST" action="{{ route('crearcarrera') }}">
        @csrf
        <div class="form-group row">
            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Carrera</label>

            <div class="col-md-6">
                <input id="codigo" type="text" class="form-control" name="codigo" required autofocus>

            </div>
        </div>

        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre Carrera</label>

            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>

            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                     Agregar
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
