@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')

<center><h1>Aqui se administran los usuarios</h1></center>

<center><a href="{{ route('usuario.create') }}"><button class="btn btn-primary btn-lg" type="button">Crear Usuario</button></a></center>
<br>
<a href="{{ route('home') }}"><button class="btn btn-dark btn-lg btn-block" type="button">Volver Menu</button></a>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
