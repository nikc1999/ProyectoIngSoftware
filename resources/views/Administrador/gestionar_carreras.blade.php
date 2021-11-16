@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Carreras</h2>
        </div>
        <br>
        <a href="/agregarcarrera"><button style="color:white; background-color:rgb(0,181,226)" class="btn" type="button">Crear Carrera</button></a>
        <a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a>
        <br>
        @if ($datos['carreras']->isEmpty())
            <br>
            <br>
            <div class="alert alert-danger" role="alert">
                No existen carreras en el sistema
            </div>
        @else
        <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>NOMBRE</th>
                        <th>EDITAR</th>
                        <th>JEFE CARRERA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos['carreras'] as $car)
                        <tr>
                            <td>{!! $car->codigo !!}</td>
                            <td>{!! $car->nombre !!}</td>
                            <td><a class="btn btn-outline-rgb" style="color:white; background-color:rgb(0,181,226)" href={{ route('carrera.edit', [$car]) }}>Editar</a></td>
                            @foreach($datos['usuarios'] as $us)
                                @if ($car->id == $us->carrera_id && $us->rol == 'Jefe de Carrera')
                                    <td>{!! $us->name !!}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
<br>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
