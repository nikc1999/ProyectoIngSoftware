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




@endif
</div>
</div>
</div>

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
