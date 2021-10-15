@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
    @if($datos['usuario']->rol=='Administrador')
        <div class = "container">
            <div class="card">
            <center>
            <form id="formulario" method="POST" action="{{ route('usuario.update', [$datos['usuario']]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar nombre:</label>
                        <input id="nombre" type="text" value="{{ $datos['usuario']->name }}" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required>
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar rut:</label>
                        <input id="rut" type="text" value="{{ $datos['usuario']->rut }}" class="form-control @error('rut') is-invalid @enderror" name="rut" required>
                        @error('rut')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar correo:</label>
                        <input id="email" type="email" value="{{ $datos['usuario']->email }}" class="form-control @error('email') is-invalid @enderror" name="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary">{{ __('Editar') }}</button>
                </div>
            </form></center>
        </div>
    @else
        <div class = "container">
                <div class="card">
            <center>
            <form id="formulario" method="POST" action="{{ route('usuario.update', [$datos['usuario']]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar nombre:</label>
                        <input id="nombre" type="text" value="{{ $datos['usuario']->name }}" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required>
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar rut:</label>
                        <input id="rut" type="text" value="{{ $datos['usuario']->rut }}" class="form-control @error('rut') is-invalid @enderror" name="rut" required>
                        @error('rut')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar correo:</label>
                        <input id="email" type="email" value="{{ $datos['usuario']->email }}" class="form-control @error('email') is-invalid @enderror" name="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="form-control-label" style="color: black">Editar rol</label>

                        <select class="form-control @error('rol') is-invalid @enderror" name="rol" id="rol">
                            <option value="{{ $datos['usuario']->rol }}">Mantener mismo rol</option>
                            <option value="Jefe de Carrera">Jefe de carrera</option>
                            <option value="Estudiante">Estudiante</option>
                        </select>
                        @error('rol')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div  class="form-group col-md-6">
                    <label for="form-control-label">Editar carrera</label>
                    <select class="form-control @error('carrera') is-invalid @enderror" value="{{ $datos['usuario']->carrera }}" name="carrera" value="{{ old('carrera') }}" id="carrera">
                        <option value="{{ $datos['usuario']->carrera_id }}">Mantener misma carrera</option>
                        @foreach($datos['carreras'] as $car)
                            <option value='{{$car->id}}'>{{$car->nombre}}</option>
                        @endforeach
                    </select>
                    @error('carrera')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary">{{ __('Editar') }}</button>
                </div>
            </form></center>
        </div>
    @endif
<script>

    const rolSelect = document.getElementById('rol')
    const carreraSelect = document.getElementById('carrera')
    const optionSelect = document.getElementById("carrera").getElementsByTagName("option")

    //variable de carreras que llegan desde el controlador de carreras
    const listaCarreras = {!! json_encode($datos['carreras']) !!}
    console.log(listaCarreras);
    rolSelect.addEventListener('change', function(e){
        if (rolSelect.value === 'Jefe de Carrera') {
            listaCarreras.forEach(carreras => {
               carreras.users.forEach(user =>{
                    if(user.rol === "Jefe de Carrera") {
                        for(let i = 0; i < optionSelect.length; i++){
                            if(carreras.id == optionSelect[i].value){
                                optionSelect[i].style.display = "none"
                            }
                        }
                    }
                })
            })
        }
        else{
            listaCarreras.forEach(carreras => {
               carreras.users.forEach(user =>{
                    for(let i = 0; i < optionSelect.length; i++){
                        if(carreras.id == optionSelect[i].value){
                             optionSelect[i].style.display = "unset"
                         }
                     }
                })
            })
        }
    })

</script>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
