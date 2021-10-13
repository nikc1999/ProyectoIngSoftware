@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')

<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Gestionar Carreras</h2>
        </div>
        <center><a href="{{ route('usuario.create') }}"><button class="btn btn-primary btn-lg" type="button">Crear Usuario</button></a></center>


        @if ($usuarios->isEmpty())
            <div>No hay Usuarios</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>RUT</th>
                        <th>NOMBRE</th>
                        <th>CORREO</th>
                        <th>ROL</th>
                        <th>CARRERA</th>
                        <th>EDITAR</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{!! $usuario->rut !!}</td>
                            <td>{!! $usuario->name !!}</td>
                            <td>{!! $usuario->email !!}</td>
                            <td>{!! $usuario->rol !!}</td>
                            <td>{!! $usuario->carrera_id !!}</td>



                            {{-- <td><a class="btn btn-info" href={{ route('carrera.edit', [$car]) }}>Editar</a></td> --}}
                            {{-- @foreach($datos['usuarios'] as $us)
                                @if ($car->id == $us->carrera_id && $us->rol == 'Jefe de Carrera')
                                    <td>{!! $us->name !!}</td>
                                @endif
                            @endforeach --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
{{-- aaaaaa --}}

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
