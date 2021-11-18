@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Jefe de Carrera')
    <div class="">
        <center><h1>Buscar Estudiante</h1></center>
    </div>

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
                                <button id="boton"
                                    class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
    <br>
    @if (!is_null($datos['estudiante']))
        <center><div>
            <h3>Informacion Estudiante:</h3>
            <h4>Rut Estudiante: {{$datos['estudiante']->rut}}</h4>
            <h4>Nombre Estudiante: {{$datos['estudiante']->name}}</h4>
            <h4>Carrera Estudiante: {{$datos['carrera']->nombre}}</h4>
            <h4>Correo Estudiante: {{$datos['estudiante']->email}}</h4>
        </div></center>
        <br>

        <table class="table" id="TablaNormal">
            <thead>
                <tr>
                    <th>N° SOLICITUD</th>
                    <th>TIPO SOLICITUD</th>
                    <th>FECHA SOLICITUD</th>
                    <th>RESOLVER</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                @foreach($datos['solicitudes'] as $solicitud)
                    <td>{!! $solicitud->id !!}</td>
                    @if ($solicitud->tipo == 'Facilidades')
                        <td>{!! $solicitud->tipo_facilidad !!}</td>
                    @else
                        <td>{!! $solicitud->tipo !!}</td>
                    @endif
                    <td>{!! $solicitud->updated_at !!}</td>
                    <td><a style="color:white; background-color:rgb(0,181,226)" class="btn btn-outline-info" href={{ route('buscarestudiante.edit', [$datos['estudiante']->id]) }}>Resolver</a></td>
                </tr>
                @endforeach

        </table>


    @endif



@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
