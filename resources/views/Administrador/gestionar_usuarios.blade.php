@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')

<h1>Aqui se administran los usuarios</h1>

<center><a href="/agregarusuario"><button class="btn btn-primary" type="button">Crear Usuario</button></a></center>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
