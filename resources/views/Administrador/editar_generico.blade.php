@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" method="POST" action="{{ route('usuario.update', [$usuario]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="col-md-2">
                <label class="form-control-label">Nuevo nombre:</label>
                <input id="name" type="text" class="form-control" name="name" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label class="form-control-label">Nuevo rut:</label>
                <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" required>
                @error('rut')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label class="form-control-label">Nuevo correo:</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="form-control-label" style="color: black">Nuevo rol</label>

                <select class="form-control" name="rol" id="rol">
                    <option>Seleccione un rol</option>
                    <option value="Jefe de Carrera">Jefe de carrera</option>
                    <option value="Alumno">Alumno</option>
                </select>
        </div>
        <div class="form-group">
            <label for="form-control-label">Nueva carrera</label>
            <select class="form-control @error('carrera') is-invalid @enderror" name="carrera" value="{{ old('carrera') }}" id="carrera">
                <option value={{null}}>Seleccione una carrera</option>
                @foreach($carreras as $car)
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

<script>

    const rolSelect = document.getElementById('rol')
    const carreraSelect = document.getElementById('carrera')
    const optionSelect = document.getElementById("carrera").getElementsByTagName("option")

    //variable de carreras que llegan desde el controlador de carreras
    const listaCarreras = {!! json_encode($carreras) !!}
    console.log(listaCarreras);
    rolSelect.addEventListener('change', function(e){
        if (rolSelect.value === 'Jefe de Carrera') {
            listaCarreras.forEach(carrera => {
               carrera.users.forEach(user =>{
                    if(user.rol === "Jefe de Carrera") {
                        for(let i = 0; i < optionSelect.length; i++){
                            if(carrera.id == optionSelect[i].value){
                                optionSelect[i].style.display = "none"
                            }
                        }
                    }
                })
            })
        }
        else{
            listaCarreras.forEach(carrera => {
               carrera.users.forEach(user =>{
                    for(let i = 0; i < optionSelect.length; i++){
                        if(carrera.id == optionSelect[i].value){
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
