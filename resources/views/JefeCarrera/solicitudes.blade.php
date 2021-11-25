@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Solicitudes Pendientes</h2>
            <form method="GET" action="{{ route('mostrarSolicitudesFiltrar') }}"> <!-- Acá se usa el store pa filtrar solicitudes por tipo-->
                <div class="form-group" style="width: 240px;">
                    <label for="form-control-label" style="color: black">Tipo Solicitud</label>
                    <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                        <option value= >Seleccione tipo de solicitud</option>
                        <option value="Sobrecupo">Sobrecupo</option>
                        <option value="Cambio paralelo">Cambio de Paralelo</option>
                        <option value="Eliminacion asignatura">Eliminación de Asignatura</option>
                        <option value="Inscripcion asignatura">Inscripción de Asignatura</option>
                        <option value="Ayudantia">Ayudantía</option>
                        <option value="Facilidades">Facilidades Académicas</option>
                    </select>

                    @error('tipo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button style="color:white; background-color:rgb(188,97,36)" class="btn">Filtrar Tipo</button>
                <a href={{ route('mostrarSolicitudesFiltrar') }}><button style="color:white; background-color:rgb(164,82,72)" class="btn" type="button">Mostrar todos</button></a>
            </form>
        </div>

        <br>

        <form method="GET" action="{{ route('solicitudJDC.index') }}">
            <input type="text" name="search" id="search" placeholder="N° Solicitud">
            <button style="color:white; background-color:rgb(188,97,36)" class="btn">Buscar Solicitud</button>
        </form>

        <br>

        @if(is_null($datos['solicitudes']))
            <br>
            <br>
            <div class="alert alert-danger" role="alert">
                El número de la solicitud no existe
            </div>

        @else
            @if($datos['solicitudes']->isEmpty())
                <br>
                <br>
                <div class="alert alert-danger" role="alert">
                    No existen solicitudes por resolver
                </div>
            @else
            <br>
                <table class="table" id="TablaNormal">
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
                        <tr>
                        @foreach ($datos['usuarios'] as $us)

                            @foreach($datos['solicitudes'] as $solicitud)

                                @if($us->id == $solicitud->user_id && $solicitud->estado == 'Pendiente')
                                    <td>{!! $solicitud->id !!}</td>
                                    @if ($solicitud->tipo == 'Facilidades')
                                        <td>{!! $solicitud->tipo_facilidad !!}</td>
                                    @else
                                        <td>{!! $solicitud->tipo !!}</td>
                                    @endif
                                    <td>{!! $solicitud->updated_at !!}</td>
                                    <td>{!! $us->rut !!}</td>
                                    <td>{!! $us->name !!}</td>
                                    <td><a style="color:white; background-color:rgb(0,181,226)" class="btn btn-outline-info" href={{ route('solicitudJDC.edit', [$solicitud->id]) }}>Resolver</a></td>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                </table>
            @endif
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
