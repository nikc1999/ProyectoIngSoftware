@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')
<div class="">
    <center><h1>Menú Administrador</h1></center>
</div>
<br>

<div class="d-grid gap-2">
    <center><a href={{ route('usuario.index')}}><button style="color:white; background-color:rgb(205,167,136)" class="btn" type="button">Administrar Usuarios</button></a></center>
    <br>
    <center><a href={{ route('mostrarcarreras')}}><button  style="color:white; background-color:rgb(205,167,136)" class="btn" type="button">Administrar Carreras</button></a></center>
</div>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
