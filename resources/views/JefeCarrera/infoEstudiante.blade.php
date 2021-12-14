@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
<h1>Información Estudiante</h1>

<br>
@if(is_null($datos['solicitudes']) || $datos['solicitudes']->isEmpty())
            <br>
            <div class="alert alert-danger" role="alert">
                No existen solicitudes pendientes
            </div>
@else
<br>
<br>
<table class="table">
    <thead>
        <tr>
            <th>N° SOLICITUD</th>
            <th>TIPO SOLICITUD</th>
            <th>FECHA SOLICITUD</th>
            <th>RUT</th>
            <th>NOMBRE</th>
            <th>TELÉFONO</th>
            <th>CORREO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        @foreach ($datos['usuarios'] as $us)
            @foreach($datos['solicitudes'] as $solicitud)
                    <td>{!! $solicitud->id !!}</td>
                    @if ($solicitud->tipo == 'Facilidades')
                        <td>{!! $solicitud->tipo_facilidad !!}</td>
                    @else
                        <td>{!! $solicitud->tipo !!}</td>
                    @endif
                    <td>{!! $solicitud->updated_at !!}</td>
                    <td>{!! $us->rut !!}</td>
                    <td>{!! $us->name !!}</td>
                    <td>{!! $solicitud->telefono !!}</td>
                    <td>{!! $us->email !!}</td>
            </tr>



            @endforeach
        @endforeach
    </tbody>
</table>

<br>
<br>



<div class="row">
    <div class="col">
        <table class="table" style="width:240px;">
            <tbody>

                @if($solicitud->nombre_asignatura != null)
                <tr>
                    <th scope="row">Nombre Asignatura</th>
                    <td>{!! $solicitud->nombre_asignatura !!}</td>
                </tr>
                @endif

                @if($solicitud->NRC != null)
                <tr>
                    <th scope="row">NRC</th>
                    <td>{!! $solicitud->NRC !!}</td>
                </tr>
                @endif

                @if($solicitud->nombre_profesor != null)
                <tr>
                    <th scope="row">Profesor</th>
                    <td>{!! $solicitud->nombre_profesor !!}</td>
                </tr>
                @endif

                @if($solicitud->calificacion_aprob != null)
                <tr>
                    <th scope="row">Calificacion aprobada</th>
                    <td>{!! $solicitud->calificacion_aprob !!}</td>
                </tr>
                @endif

                @if($solicitud->cant_ayudantias != null)
                <tr>
                    <th scope="row">Ayudantías realizadas</th>
                    <td>{!! $solicitud->cant_ayudantias !!}</td>
                </tr>
                @endif

                @if($solicitud->detalles_estudiante != null)
                <tr>
                    <th scope="row">Razón</th>
                    <td>{!! $solicitud->detalles_estudiante !!}</td>
                </tr>
                @endif

                @if($solicitud->archivos != null)
                <tr>
                    <th scope="row">Archivos</th>
                    <td>{!! $solicitud->archivos !!}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="col">
        <form id="formulario" method="POST" action="{{ route('solicitud.update', [$datos['solicitudes'][0]]) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="user" id="user" value={{Auth::user()->id}} hidden>
        <div class="form-group">
            <label for="form-control-label" style="color: black">Seleccionar resolución</label>

            <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
                <option value={{null}} >Seleccione una opción</option>
                <option value="Aceptada">Aceptar solicitud</option>
                <option value="Aceptada con observaciones">Aceptar con Observacion</option>
                <option value="Rechazada">Rechazar solicitud</option>
            </select>
            @error('estado')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <br>

        <div class="form-group" id="comentario" hidden>
            <label class="form-control-label">Observación al estudiante</label>
            <input id="observacion" type="text"
                class="form-control @error('observacion') is-invalid @enderror" name="observacion"
                value="{{ old('observacion') }}" autocomplete="observacion" autofocus>

            @error('observacion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div hidden id="groupButton" class="col-lg-12 py-3">
            <div class="col-lg-12 text-center">
                <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="boton" class="btn">Enviar</button>
            </div>
        </div>
        </form>
    </div>
</div>


@if ($datos['solicitudes'][0]->estado == 'Pendiente')



@else

<h2>Solicitud ya revisada</h2>

@endif



@endif
</div>
</div>
</div>

<script type="text/javascript">
    const selectEstado = document.getElementById('estado');
    const comentarioMostrar = document.getElementById('comentario');
    const botonEnviar = document.getElementById('groupButton');

        switch(selectEstado.value) {
            case "Aceptada":
            comentarioMostrar.hidden = true;
            botonEnviar.hidden = false;
            break;

            case "Aceptada con observaciones":
            comentarioMostrar.hidden = false;
            botonEnviar.hidden = false;
            break;

            case "Rechazada":
            comentarioMostrar.hidden = false;
            botonEnviar.hidden = false;
            break;

            default:
            comentarioMostrar.hidden = true;
            botonEnviar.hidden = true;
            break;
        }

    selectEstado.addEventListener('change', () => {
            switch (selectEstado.value) {
                case "Aceptada":
                    comentarioMostrar.hidden = true;
                    botonEnviar.hidden = false;
                    break;

                case "Aceptada con observaciones":
                    comentarioMostrar.hidden = false;
                    botonEnviar.hidden = false;
                    break;

                case "Rechazada":
                    comentarioMostrar.hidden = false;
                    botonEnviar.hidden = false;
                    break;

                default:
                    comentarioMostrar.hidden = true;
                    botonEnviar.hidden = true;
                    break;
                }

        })
</script>

@if($datos['ruta'] == 'panel')
    <center><a href={{ route('mostrarSolicitudesPendientesJefe')}}><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
    <a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>
@else
    <center><a href={{ route('buscarestudiante.index')}}><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
    <a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>
@endif



@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection





