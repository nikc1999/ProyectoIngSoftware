@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Estudiante')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Solicitudes</h2>
        </div>
        <a class="nav-link" href={{ route('solicitud.create')}}><button class="btn" style="color:white; background-color:rgb(0,181,226)" type="button">Crear Solicitud</button></a>
        @if ($solicitudes->isEmpty())
            <br>
            <br>
            <div class="alert alert-danger" role="alert">
                No hay solicitudes ingresadas
            </div>
        @else
        <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>N° SOLICITUD</th>
                        <th>TIPO SOLICITUD</th>
                        <th>FECHA SOLICITUD</th>
                        <th>ESTADO</th>
                        <th>EDITAR</th>
                        <th>ANULAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{!! $solicitud->id !!}</td>
                            @if($solicitud->tipo == 'Facilidades')
                                <td>{!! $solicitud->tipo !!}: {!! $solicitud->tipo_facilidad !!}</td>
                            @else
                                <td>{!! $solicitud->tipo !!}</td>
                            @endif
                            <td>{!! $solicitud->updated_at !!}</td>
                            <td>{!! $solicitud->estado !!}</td>
                            @if ($solicitud->estado == 'Anulada' || $solicitud->estado == 'Aceptada')
                                <td>No editable</td>
                                <td>No disponible</td>
                            @else
                                <td><a class="btn btn-outline-rgb" style="color:white; background-color:rgb(0,181,226)" href={{ route('solicitud.show', [$solicitud]) }}>Editar</a></td>
                                <td><a class="btn btn-outline-rgb" href={{ route('solicitud.edit', [$solicitud])}} style="color:white; background-color:rgb(196,49,44)">Anular</a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
<br>

<center><a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
