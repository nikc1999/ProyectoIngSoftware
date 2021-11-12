@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Estudiante')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Solicitudes</h2>
        </div>
        <a class="nav-link" href={{ route('solicitud.create')}}><button class="btn btn-primary" type="button">Crear Solicitud</button></a>
        @if ($solicitudes->isEmpty())
            <br>
            <br>
            <div class="alert alert-danger" role="alert">
                No existen solicitudes realizadas por el estudiante
            </div>
        @else
        <br>
            <table class="table">
                Si hay solicitudes, pero nos da flojera mostrárselas <!-- aqui se pone la tabla quedespliega la informacion de cada solicitud del estudiante xoxoxo -->
            </table>
        @endif
    </div>
</div>
<br>

<center><a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menu</button></a></center>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
