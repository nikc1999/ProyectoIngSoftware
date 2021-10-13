@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Gestionar Carreras</h2>
        </div>
        <center><a class="nav-link" href="/agregarcarrera"><button class="btn btn-primary" type="button">Crear Carrera</button></a></center>


        @if ($carrera->isEmpty())
            <div>No hay Carreras</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrera as $car)
                        <tr>
                            <td>{!! $car->codigo !!}</td>
                            <td>{!! $car->nombre !!}</td>
                            <td><a class="btn btn-info" href={{ route('carrera.edit', [$car]) }}>Editar</a></td>
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
