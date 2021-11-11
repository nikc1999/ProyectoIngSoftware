@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Estudiante')
<div class="">
    <center><h1>Menú Estudiante</h1></center>
</div>
<br>

<div class="d-grid gap-2">
    <center><a href={{ route('solicitud.index')}}><button class="btn btn-primary" type="button">Administrar Solicitudes</button></a></center>
</div>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
