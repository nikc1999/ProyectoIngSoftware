@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')
<div class="container">
    <div class="row">
        <h1>Panel de usuarios</h1>
        <div class="col-6"></div>
        <div>
            <a href={{ route('usuario.index')}}><button style="color:white; background-color:rgb(164,82,72)" class="btn" type="button">Mostrar todos</button></a>
            <a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a>
        </div>

    </div>


<br>



<div class="container" role="group" aria-label="Basic example">
        <form method="GET" action="{{ route('usuario.index') }}">
            <input type="text" name="search" id="search" placeholder="Buscar por Rut">
            <button style="color:white; background-color:rgb(188,97,36)" class="btn">Buscar</button>

        <a href="{{ route('usuario.create') }}"><button style="color:white; background-color:rgb(0,181,226)" class="btn" type="button">Crear Usuario</button></a>
        <a href="/menucarga"><button style="color:white; background-color:rgb(0,181,226)" class="btn" type="button">Carga Masiva</button></a>

    </form>
</div>

@if ($usuarios->isEmpty())
<br>
<br>
<div class="alert alert-danger" role="alert">
    No existe usuario con ese rut en el sistema.
</div>
@else
<br>
<br>
<table class="table">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>RUT</th>
            <th>ROL</th>
            <th>EDITAR</th>
            <th><center>HABILITACIÓN</center></th>
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
                <td><a style="color:white; background-color:rgb(0,181,226)" class="btn btn-outline-info" href={{ route('usuario.edit', [$user]) }}>Editar</a></td>
                <td><center>No modificable</center></td>
                <td>No restablecible</td>
            </tr>
            @else
                <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->rut !!}</td>
                <td>{!! $user->rol !!}</td>
                <td><a style="color:white; background-color:rgb(0,181,226)" class="btn btn-outline-info" href={{ route('usuario.edit', [$user]) }}>Editar</a></td>

                <form method="POST" action="{{ route('habilitar', ['id' => $user]) }}">
                    @csrf
                @if ($user->habilitado==0)
                    <td><center><button style="background-color:rgb(72,162,79); color:white" class="btn">Habilitar</button></td></center>
                @else
                    <td><center><button style="background-color:rgb(196,49,44); color:white" class="btn">Deshabilitar</button></td></center>
                    @endif
                </form>

                <form class="formulariorestablecer" method="POST" action="{{ route('restablecer', ['id' => $user]) }}">
                    @csrf
                    <td><button style='background-color:rgb(180,41,160); color:white' class="btn botonrestablecer">Restablecer</button></td>
                </form>
                </tr>

            @endif

        @endforeach
    </tbody>
</table>
@endif
</div>
</div>
</div>

<script>
    const button = document.getElementsByClassName("botonrestablecer")
    const form = document.getElementsByClassName('formulariorestablecer')
    for (let i = 0; i < button.length; i++) {
        button[i].addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Contraseña Restablecida',
        showConfirmButton: false,
        timer: 2000,
        })
        form[i].submit();
    })
    }

</script>

<br>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
