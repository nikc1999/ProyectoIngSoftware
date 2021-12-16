@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Administrador')
<div>
    <form id="formulario" method="POST" action="{{ route('crearcarrera') }}">
        @csrf
        <div class="form-group row">
            <label for="codigo" class="col-md-4 col-form-label text-md-right">Código Carrera</label>

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
                <input id="nombre" type="text" class="form-control  @error('nombre') is-invalid @enderror" name="nombre" required autofocus>
                @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button style="color:white; background-color:rgb(0,181,226)" id = "boton" type="submit" class="btn btn-info">
                    Agregar Carrera
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
            title: 'El código de la carrera no es posible modificarlo una vez registrado en el sistema ¿Realizar operación?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Confirmar',
            confirmButtonColor: '#00b5e2',
            denyButtonColor: '#000000',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                Swal.fire({
                    title: 'No guardado',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#000000',
                })
            }
        })
    })
</script>

<br>
<br>
<center><a href="/usuario"><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a> </center>


@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
