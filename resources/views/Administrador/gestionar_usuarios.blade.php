@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')

<center><h1>Aqui se administran los usuarios</h1></center>
<center><a href="{{ route('usuario.create') }}"><button class="btn btn-primary" type="button">Crear Usuario</button></a></center>
<br>

@if ($usuarios->isEmpty())
<div>No hay Carreras</div>
@else
<table class="table">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>RUT</th>
            <th>ROL</th>
            <th>EDITAR</th>
            <th>HABILITACION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $user)
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->rut !!}</td>
                <td>{!! $user->rol !!}</td>
                <td><a class="btn btn-info" href={{ route('usuario.edit', [$user]) }}>Editar</a></td>
                @if ($user->habilitado==0)
                    <td><a class="btn btn-success" href={{ route('usuario.edit', [$user]) }}>Habilitar</a></td>
                @else
                    <td><a class="btn btn-danger" href={{ route('usuario.edit', [$user]) }}>Deshabilitar</a></td>
                    @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endif
</div>
</div>


<br>
<a href="{{ route('home') }}"><button class="btn btn-dark btn-lg btn-block" type="button">Volver Menu</button></a>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
