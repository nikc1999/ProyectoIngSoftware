@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Administrador')
<div>
    <form id="formulario" method="POST" action="{{ route('crearcarrera') }}">
        @csrf
        <div class="form-group row">
            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Carrera</label>

            <div class="col-md-6">
                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}"  name="codigo" required autofocus>
                @error('codigo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
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
                <button id = "boton" type="submit" class="btn btn-primary">
                     Agregar
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    const button = document.getElementById('boton');
    const form = document.getElementById('formulario')
    button.addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Estas seguro que quieres agregar la carrera?, esta accion es irreversible',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Guardar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                Swal.fire('No guardado', '', 'info')
            }
        })
    })
</script>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
