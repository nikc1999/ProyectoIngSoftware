@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <h2 style="font-weight: bold">Panel de Solicitudes</h2>
                <div class="col-6"></div>

                <div class="pl-5">
                    <a href={{ route('mostrarSolicitudesFiltrar') }}><button style="color:white; background-color:rgb(164,82,72)" class="btn" type="button">Mostrar todos</button></a>
                    <a class="pl-2" href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a>
                </div>

            </div>
        <span>
            <br>
            <div class= "row pl-5" >
                <form method="GET" action="{{ route('mostrarSolicitudesFiltrar') }}">
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
                    <button style="color:white; background-color:rgb(188,97,36)" data-toggle="tooltip" data-placement="right" title="Filtra las solicitudes según su tipo de solicitud" class="btn">Filtrar Tipo</button>
                </form>

                <form class= "pl-5" method="GET" action="{{ route('mostrarEstadosFiltrar') }}">
                    <div class="form-group" style="width: 240px;">
                        <label for="form-control-label" style="color: black">Estado Solicitud</label>
                        <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
                            <option value= >Seleccione estado de solicitud</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aceptada">Aceptada</option>
                            <option value="Aceptada con observaciones">Aceptada con observaciones</option>
                            <option value="Rechazada">Rechazada</option>
                        </select>
                        @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button style="color:white; background-color:rgb(188,97,36)" data-toggle="tooltip" data-placement="right" title="Filtra las solicitudes según el estado de la solicitud" class="btn">Filtrar estado</button>
                </form>
                <div class="pt-2 pl-5">
                    <br>
                    <form method="GET" action="{{ route('solicitudJDC.index') }}">
                        <input type="text" name="search" id="search" placeholder="N° Solicitud">
                        <button style="color:white; background-color:rgb(188,97,36)" class="btn">Buscar Solicitud</button>
                    </form>
                </div>

            </div>

        </span>
        <br>
        </div>




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
                            <th>ESTADO</th>
                            <th>FECHA SOLICITUD</th>
                            <th>RUT ESTUDIANTE</th>
                            <th>NOMBRE ESTUDIANTE</th>
                            <th>DETALLES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach ($datos['usuarios'] as $us)

                            @foreach($datos['solicitudes'] as $solicitud)

                                @if($us->id == $solicitud->user_id && $solicitud->estado != 'Anulada')
                                    <td>{!! $solicitud->id !!}</td>
                                    @if ($solicitud->tipo == 'Facilidades')
                                        <td>{!! $solicitud->tipo_facilidad !!}</td>
                                    @else
                                        <td>{!! $solicitud->tipo !!}</td>
                                    @endif
                                    <td>{!! $solicitud->estado !!}</td>
                                    <td>{!! $solicitud->updated_at !!}</td>
                                    <td>{!! $us->rut !!}</td>
                                    <td>{!! $us->name !!}</td>
                                    <td><a style="color:white; background-color:rgb(0,181,226)" class="btn btn-outline-info" href={{ route('solicitudJDC.edit', [$solicitud->id]) }}>Ver</a></td>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                </table>
            @endif
        @endif
    </div>
</div>




@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
