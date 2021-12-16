@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Jefe de Carrera')
    <div class="">
        <center><h1>Menú Jefe de Carrera</h1></center>
    </div>
    <br>
    <div class="d-grid gap-2">
        <center><a href={{ route('mostrarSolicitudesPendientesJefe')}}><button style="color:white; background-color:rgb(205,167,136)" class="btn" type="button">Administrar Solicitudes</button></a></center>
        <br>
        <center><a href={{ route('buscarestudiante.index')}}><button style="color:white; background-color:rgb(205,167,136); width: 175px;" class="btn" type="button">Buscar Estudiante</button></a></center>
        <br>
        <center><a href={{ route('estadistica')}}><button style="color:white; background-color:rgb(205,167,136); width: 175px;" class="btn" type="button">Estadistica Estudiante</button></a></center>
    </div>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
