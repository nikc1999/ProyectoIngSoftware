@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Gestionar Carreras</h2>
        </div>
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
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
