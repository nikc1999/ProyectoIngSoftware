<!--use Illuminate\Support\Facades\Auth;-->
@extends('layouts.app')
@section('content')
@if (Auth::user()->rol=='Administrador')
    @if($carreras->isEmpty())
        <center><h1> No hay carreras</h1></center>
        <br>
        <!--<center><a href="/usuario"><button class="btn btn-primary" type="button">Regresar</button></a></center>-->

    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h3><center>Crear Usuario</center></h3></div>
                        <div class="card-body" style = "border: 1px solid grey;">

                            <form method="POST" action="{{ route('usuario.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="rut" class="col-md-4 col-form-label text-md-right">{{ __('Rut usuario') }}</label>

                                    <div class="col-md-6">
                                        <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut">

                                        @error('rut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="form-control-label" style="color: black">Rol</label>

                                        <select class="form-control" name="rol" id="rol">
                                            <option>Seleccione un rol</option>
                                            <option value="Jefe de Carrera">Jefe de carrera</option>
                                            <option value="Alumno">Alumno</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="form-control-label">Carrera</label>
                                    <select class="form-control" name="carrera" id="carrera">
                                        <option value={{null}}>Seleccione una carrera</option>
                                        @foreach($carreras as $car)
                                            <option value='{{$car->id}}'>{{$car->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button id="boton"type="submit" class="btn btn-outline-primary">
                                            Registrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
<br>
<center><a href="/usuario"><button class="btn btn-danger btn-lg btn-block" type="button">Volver</button></a>
<center><a href="{{ route('home') }}"><button class="btn btn-secondary btn-lg btn-block" type="button">Volver Menu</button></a>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
