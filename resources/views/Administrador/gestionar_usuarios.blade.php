@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Administrador')
<div class="container col-md-8 col-md-offset-2">
<h1>Panel de usuarios</h1>

<br>

<div class="btn-group" role="group" aria-label="Basic example">
        <form method="GET" action="{{ route('usuario.index') }}">
            <input type="text" name="search" id="search" placeholder="Buscar por Rut">
            <button class="btn btn-secondary">Buscar</button>
        </form>
        <a href={{ route('usuario.index')}}><button class="btn btn-secondary" type="button">Mostrar todos</button></a>
            <p style="text-align:right;">
            <a href="{{ route('usuario.create') }}"><button class="btn btn-primary" type="button">Crear Usuario</button></a>
            </p>
  </div>

@if ($usuarios->isEmpty())
<br>
<br>
<div class="alert alert-danger" role="alert">
    No existe usuario con ese rut en el sistema
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
                <td><center>No modificable</center></td>
                <td>No restablecible</td>
            </tr>
            @else
                <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->rut !!}</td>
                <td>{!! $user->rol !!}</td>
                <td><a class="btn btn-primary" href={{ route('usuario.edit', [$user]) }}>Editar</a></td>

                <form method="POST" action="{{ route('habilitar', ['id' => $user]) }}">
                    @csrf
                @if ($user->habilitado==0)
                    <td><center><button class="btn btn-success">Habilitar</button></td></center>
                @else
                    <td><center><button class="btn btn-danger">Deshabilitar</button></td></center>
                    @endif
                </form>

                <form class="formulariorestablecer" method="POST" action="{{ route('restablecer', ['id' => $user]) }}">
                    @csrf
                    <td><button class="btn btn-warning botonrestablecer">Restablecer</button></td>
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
<a href="{{ route('home') }}"><button class="btn btn-dark btn-lg btn-block" type="button">Volver Menu</button></a>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
