@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
    <div class="">
        <center><h1>Buscar Estudiante</h1></center>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-users"></i>
            </div>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form id="formulario" method="POST" action="{{ route('buscarEstudiante') }} ">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Rut Estudiante</label>
                            <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut" autofocus>
                            @error('rut')
                                <span class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="boton" style="color:white; background-color:rgb(0,181,226)"
                                    class="btn">{{ __('Buscar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
    <br>

    @if ($datos['estudiante'] == 'hola' && $rut == '')

    @elseif(!is_null($datos['estudiante']))

        <table class="table" id="TablaNormal">
            <thead>
                <tr>
                    <th>Rut Estudiante:</th>
                    <th>Nombre Estudiante:</th>
                    <th>Carrera Estudiante:</th>
                    <th>Correo Estudiante:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{!! $datos['estudiante']->rut !!}</td>
                <td>{!! $datos['estudiante']->name !!}</td>
                <td>{!! $datos['carrera']->nombre !!}</td>
                <td>{!! $datos['estudiante']->email !!}</td>
                </tr>

        </table>
        <br>
        <table class="table" id="TablaNormal">
            <thead>
                <tr>
                    <th>N° SOLICITUD</th>
                    <th>TIPO SOLICITUD</th>
                    <th>ESTADO</th>
                    <th>FECHA SOLICITUD</th>
                    <th>VISUALIZAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                @foreach($datos['solicitudes'] as $solicitud)
                    @if($solicitud->estado == 'Pendiente')
                        <td>{!! $solicitud->id !!}</td>
                        @if ($solicitud->tipo == 'Facilidades')
                            <td>{!! $solicitud->tipo_facilidad !!}</td>
                        @else
                            <td>{!! $solicitud->tipo !!}</td>
                        @endif
                        <td>{!! $solicitud->estado !!}</td>
                        <td>{!! $solicitud->updated_at !!}</td>
                        <td><a style="color:white; background-color:rgb(0,181,226)" class="btn btn-outline-info" href={{ route('buscarestudiante.edit', [$solicitud->id]) }}>Ver Detalle</a></td>
                    @else

                    @endif
                </tr>
                @endforeach
        </table>
    @else
    <div class="alert alert-danger" role="alert">
        <center>El RUT ingresado no es de un estudiante o usted no tiene los privilegios para visualizar la información del rut ingresado</center>
    </div>
    @endif
<br>
<center><a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>

</div>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
