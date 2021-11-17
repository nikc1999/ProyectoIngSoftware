@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Solicitudes Pendientes</h2>
        </div>

        @if(is_null($datos['solicitudes']) || $datos['solicitudes']->isEmpty())
            <br>
            <br>
            <div class="alert alert-danger" role="alert">
                No existen solicitudes pendientes
            </div>
        @else
        <br>
        <form method="GET" action="{{ route('solicitudJDC.index') }}">
            <input type="text" name="search" id="search" placeholder="N° Solicitud">
            <button style="color:white; background-color:rgb(188,97,36)" class="btn">Buscar Solicitud</button>
        </form>

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
                        @endif
                    </tr>
                    @endforeach

                    @endforeach

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
