@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Administrador')
<div>
    <form id="formulario" method="POST" action="{{ route('cargamasiva') }}" enctype="multipart/form-data">
        @csrf

        <div class="container">
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
        </div>
    </form>
</div>


<br>
<br>

<div class="containter col-md-8 col-md-offset-2 ">
    <div class= "row">
    @if(is_null($datos['usuarios_exito']))

    @else
        <div class="col" style= "width:240px ">
            <h5>Los siguientes estudiantes se han cargado al sistema:</h5>
            <br>
            <table class="table" >
                <thead>
                    <tr>
                        <th>ESTUDIANTE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach($datos['usuarios_exito'] as $usuarioE)
                        <td>{!! $usuarioE['name'] !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (is_null($datos['usuarios_fallo']))

    @else
        <div class="col" style= "width:240px ">
            <h5>Los siguientes datos no se pudieron cargar al sistema:</h5>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ESTUDIANTE</th>
                        <th>ERROR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach($datos['usuarios_fallo'] as $usuarioF)
                        <td>{!! $usuarioF['nombre'] !!}</td>
                        <td>{!! $usuarioF['error'] !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endif
<br>
<br>
<div class="col"></div>

<div class="col pl-5">
<center><a href="/usuario"><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a> </center>
</div>
</div>


<script>
    const button = document.getElementById('boton');
    const form = document.getElementById('formulario')
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
