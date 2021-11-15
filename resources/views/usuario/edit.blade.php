@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
    @if($datos['usuario']->rol=='Administrador')
        <div class = "container">
            <div class="card">
            <center>
            <form id="formularioeditaradmin" class="formularioeditar" method="POST" action="{{ route('usuario.update', [$datos['usuario']]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-control-label">Editar nombre:</label>
                        <input id="nombreadmin" type="text" value="{{ $datos['usuario']->name }}" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required>
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
                        <input id="rutadmin" type="text" value="{{ $datos['usuario']->rut }}" class="form-control @error('rut') is-invalid @enderror" name="rut" required>
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
                        <input id="emailadmin" type="email" value="{{ $datos['usuario']->email }}" class="form-control @error('email') is-invalid @enderror" name="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="botoneditaradmin" class="btn botoneditaradmin">{{ __('Editar') }}</button>
                </div>
                <br>
            </form></center>
        </div>
    @else
        <div class = "container">
                <div class="card">
            <center>
            <form id="formularioeditar" method="POST" action="{{ route('usuario.update', [$datos['usuario']]) }}">
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
                            <option value="{{ $datos['usuario']->rol }}">{{$datos['usuario']->rol}}</option>
                            @if ($datos['usuario']->rol=="Estudiante")
                            <option value="Jefe de Carrera">Jefe de carrera</option>
                            @else
                            <option value="Estudiante">Estudiante</option>
                            @endif
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
                        @foreach($datos['carreras'] as $car)
                            @if ($datos['usuario']->carrera_id == $car->id)
                                <option value='{{$car->id}}'>{{$car->codigo}} - {{$car->nombre}}</option>
                            @endif
                        @endforeach
                        @foreach($datos['carreras'] as $car)
                        @if ($datos['usuario']->carrera_id != $car->id)
                            <option value='{{$car->id}}'>{{$car->codigo}} - {{$car->nombre}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('carrera')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-2">
                    <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="botoneditar" class="btn botoneditar">{{ __('Editar') }}</button>
                </div>

            </form></center>
            <br>
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

<script>
    //Editar Admin
    const button1 = document.getElementById('botoneditaradmin')
    const form1 = document.getElementById('formularioeditaradmin')

    button1.addEventListener('click', function(e){
    const nombreadmin = document.getElementById('nombreadmin').value;
    const rutadmin = document.getElementById('rutadmin').value;
    const correoadmin= document.getElementById('emailadmin').value;
    if(nombreadmin != '' && rutadmin != '' && correoadmin != ''){
        e.preventDefault();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Usuario editado',
          showConfirmButton: false,
          timer: 2000,
        })
        form1.submit();
    }
    })
</script>

<script>
    const button2 = document.getElementById('botoneditar')
    const form2 = document.getElementById('formularioeditar')
    button2.addEventListener('click', function(e){
        const nombre = document.getElementById('nombre').value;
        const rut = document.getElementById('rut').value;
        const correo= document.getElementById('email').value;
        if(nombre != '' && rut != '' && correo != ''){
        e.preventDefault();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Usuario editado',
          showConfirmButton: false,
          timer: 2000,
        })
        form2.submit();
        }
    })

</script>


<br>
<center><a href="/usuario"><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menu</button></a> </center>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
