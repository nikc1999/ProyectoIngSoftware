@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')
<center><h1>Aqui se administran los usuarios</h1></center>
<center><a href="{{ route('usuario.create') }}"><button class="btn btn-primary" type="button">Crear Usuario</button></a></center>
<br>

@if ($usuarios->isEmpty())
<center><div>No hay Carreras</div></center>
@else
<table class="table">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>RUT</th>
            <th>ROL</th>
            <th>EDITAR</th>
            <th><center>HABILITACION</center></th>
            <th>CONTRASEÑA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $user)
            @if ($user->rol=="Administrador")
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->rut !!}</td>
                <td>{!! $user->rol !!}</td>
                <td><a class="btn btn-primary" href={{ route('usuario.edit', [$user]) }}>Editar</a></td>
                <td><center>PARAMETROS</center></td>
                <td>NO MODIFICABLE</td>
            </tr>
            @else
                <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->rut !!}</td>
                <td>{!! $user->rol !!}</td>
                {{-- <td><a class="btn btn-info" href={{ route('usuario.edit', [$user])}}>Editar</a></td> --}}
                <form method="get" action="{{ route('usuario.edit', $user) }}">
                    @csrf
                    <td><center><button class="btn btn-success">Editar</button></td></center>
                </form>

                <form method="POST" action="{{ route('habilitar', ['id' => $user]) }}">
                    @csrf
                @if ($user->habilitado==0)
                    <td><center><button class="btn btn-success">Habilitar</button></td></center>
                @else
                    <td><center><button class="btn btn-danger">Deshabilitar</button></td></center>
                    @endif
                </form>
                <td><a class="btn btn-warning" href="">Restablecer</a></td>

                </tr>

            @endif

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
