@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')

<h1>Aqui se administran los usuarios</h1>

<center><a href="{{ route('crearusuario') }}"><button class="btn btn-primary" type="button">Crear Usuario</button></a></center>
<<<<<<< HEAD
<br>
<center><a href="{{ route('home') }}"><button class="btn btn-primary" type="button">Volver Menu</button></a></center>
=======
>>>>>>> parent of e9a56d8 (Merge branch 'matiRama' into juanRama)


@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
