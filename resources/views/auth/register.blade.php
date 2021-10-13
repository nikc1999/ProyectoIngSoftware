@extends('layouts.app')
@section('content')
@if (Auth::user()->rol=='Administrador')
    @if($carrera->isEmpty())
        <h1>no hay carreras</h1>
        <center><a href="/usuario"><button class="btn btn-primary" type="button">Regresar</button></a></center>

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

                                        <select  class="form-control" name="rol" id="rol">
                                            <option selected>Seleccione un rol</option>
                                            <option value="Jefe de Carrera">Jefe de carrera</option>
                                            <option value="Alumno">Alumno</option>
                                        </select>
                                </div>


                                {{-- <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <label for="form-control-label">Carrera</label>
                                    <select class="form-control" name="carrera" id="carrera">
                                        <option selected>Seleccione una carrera</option>
                                        @foreach($carrera as $car)

                                            <option value='{{$car->id}}'>{{$car->nombre}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button id="boton"type="submit" class="btn btn-primary">
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
        const rolSelect = document.getElementById('rol');
        const carreraSelect = document.getElementById('carrera')
        //variable de carreras desde el controlador de carreras
        const listaCarreras = {!! json_encode($carrera) !!}
        if (listaCarreras.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No puedes crear usuarios sin tener carreras en el sistema!',
                footer: 'Para crear carreras has&nbsp;<a href="/carrera/create">click aca</a>'
            }).then((result) => {
                window.location.href = '/usuario'
            })
        }
        rolSelect.addEventListener('change', function(e){
            if (rolSelect.value === 'Jefe Carrera') {
                for (let index = 0; index < listaCarreras.length; index++) {
                    const element = listaCarreras[index];
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No puedes crear usuarios sin tener carreras en el sistema!',
                        footer: 'Para crear carreras has&nbsp;<a href="/carrera/create">click aca</a>'
            }).then((result) => {
                window.location.href = '/usuario'
            })
                }

            }else{
                carreraSelect.disabled = false;
            }
        })
    </script>

<script>

    const button = document.getElementById('boton');
    const form = document.getElementById('formulario')
    button.addEventListener('click', function(e){
        e.preventDefault();
        //funciona


        const rolSelect = document.getElementById('rol');
        const carreraSelect = document.getElementById('carrera')
        //variable de carreras desde el controlador de carreras
        const listaCarreras = {!! json_encode($carrera) !!}

        $carrera.forEach(element => element.id {

        });
    })


</script>


@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
