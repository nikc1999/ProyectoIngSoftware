@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')
<div class="">
    <center><h1>Menu Admin</h1></center>
</div>

<div class="d-grid gap-2">
    <center><button class="btn btn-primary" type="button">Administrar Usuarios</button></center>
    <br>
    <center><a class="btn btn-info" href={{ route('mostrarcarreras')}}>Administrar Carreras</a></center>
</div>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
