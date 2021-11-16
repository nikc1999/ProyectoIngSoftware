@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Solicitudes Pendientes</h2>
        </div>
        <br>

        <div class="d-grid gap-2">
            <center><a href={{ route('mostrarSolicitudesFiltrar')}}><button style="color:white; background-color:rgb(205,167,136)" class="btn" type="button">Filtrar Solicitudes</button></a></center>
        </div>

        <br>
        @if ($solicitudesPendientes->isEmpty())
            <br>
            <br>
            <div class="alert alert-danger" role="alert">
                No existen solicitudes pendientes
            </div>
        @else
        <br>
            <table class="table" id="TablaNormal" >
                <thead>
                    <tr>
                        <th>N° SOLICITUD</th>
                        <th>TIPO SOLICITUD</th>
                        <th>FECHA SOLICITUD</th>
                        <th>RUT ESTUDIANTE</th>
                        <th>NOMBRE ESTUDIANTE</th>
                        <th>RESOLVER</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < count($solicitudesPendientes) ; $i++  )
                        <tr>
                            <td>{!! $solicitudesPendientes[$i]->id !!}</td>
                            @if($solicitudesPendientes[$i]->tipo == 'Facilidades')
                                <td>{!! $solicitudesPendientes[$i]->tipo !!}: {!! $solicitudesPendientes[$i]->tipo_facilidad !!}</td>
                            @else
                                <td>{!! $solicitudesPendientes[$i]->tipo !!}</td>
                            @endif
                            <td>{!! $solicitudesPendientes[$i]->updated_at !!}</td>
                            <td>{!! $datosEstudiantesPendientes[$i][0] !!}</td>
                            <td>{!! $datosEstudiantesPendientes[$i][1] !!}</td>
                            <td><a class="btn btn-outline-rgb" style="color:white; background-color:rgb(0,181,226)" href={{ route('solicitud.show', [$solicitudesPendientes[$i]]) }}>Resolver</a></td>

                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    </div>
</div>





<center><a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
