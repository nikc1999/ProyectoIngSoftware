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
    @if (!is_null($estudiante))
        <h3>Informacion Alumno:</h3>
    @endif
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
