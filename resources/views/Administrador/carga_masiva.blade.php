@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Administrador')
<div>
    <form id="formulario" method="POST" action="{{ route('cargamasiva') }}">
        @csrf

        <div class="form-group row">
            <label class="form-control-label">Adjuntar Excel con los datos de estudiantes</label>

            <input id="adjunto" type="file" class="form-control @error('adjunto') is-invalid @enderror" name="adjunto">
            @error('adjunto')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button style="color:white; background-color:rgb(0,181,226)" id = "boton" type="submit" class="btn btn-info">
                    Agregar Estudiantes
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