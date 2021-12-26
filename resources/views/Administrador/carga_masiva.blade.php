@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Administrador')
<div>
    <form id="formulario" class="formulario" method="POST" action="{{ route('cargamasiva') }}" enctype="multipart/form-data">
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
                <button style="color:white; background-color:rgb(0,181,226)" id = "boton" type="submit" class="btn btn-info" onClick = "">
                    Agregar Estudiantes
                </button>
            </div>
        </div>
    </form>
</div>

<br>
<br>
<center><a href="/usuario"><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" id='salida1' type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" id='salida2' type="button">Volver Menú</button></a> </center>


<script>
    const button = document.getElementById('boton');
    const adjunto = document.getElementById('adjunto');
    const salida1 = document.getElementById('salida1');
    const salida2 = document.getElementById('salida2');
    const form = document.getElementById('formulario');
    button.addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de cargar estudiantes de forma masiva? Esta acción no puede ser anulada',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Confirmar',
            confirmButtonColor: '#00b5e2',
            denyButtonColor: '#000000',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                adjunto.hidden = true;
                button.hidden =true;
                salida1.hidden =true;
                salida2.hidden =true;
                Swal.fire('Cargando archivo.')
                Swal.showLoading()
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
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
