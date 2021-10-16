@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Carreras</h2>
        </div>
        <a class="nav-link" href="/agregarcarrera"><button class="btn btn-primary" type="button">Crear Carrera</button></a>
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
                        <th>CODIGO</th>
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
                            <td><a class="btn btn-info" href={{ route('carrera.edit', [$car]) }}>Editar</a></td>
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
<br>

<center><a href="{{ route('home') }}"><button class="btn btn-dark btn-lg btn-block" type="button">Volver Menu</button></a></center>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
