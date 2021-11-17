@extends('layouts.app')

@section('content')

@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
<h1>Informacion Estudiante</h1>

<br>
@if ($usuarios->isEmpty())
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
            <th>RUT</th>
            <th>NOMBRE</th>
            <th>CARRERA</th>
            <th>CORREO</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->rut !!}</td>
                <td>{!! $user->rol !!}</td>
                <td>{!! $user->correo !!}</td>
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


@else
@php
header("Location: /home" );
exit();
@endphp
@endif

@endsection
