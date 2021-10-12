@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')
<div class="">
    <center><h1>Menu Admin</h1></center>
</div>

<div class="d-grid gap-2">
    <center><a href={{ route('usuario.index')}}><button class="btn btn-primary" type="button">Administrar Usuarios</button></a></center>
    <br>
    <center><a href={{ route('mostrarcarreras')}}><button class="btn btn-primary" type="button">Administrar Carreras</button></a></center>
</div>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
