@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
<h1>Informacion Estudiante</h1>

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
            <th>TELEFONO</th>
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
@endif
</div>
</div>
</div>

<center><a href={{ route('mostrarSolicitudesPendientesJefe')}}><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>


@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
