@extends('layouts.app')
@section('content')

<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" class="formularioCambiar" method="POST" action="{{ route('contrasena.update', [$user]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="col-md-6">
                <label class="form-control-label">Nueva Contraseña</label>
                <input id="contrasena"  type="text" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" >
                @error('contrasena')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="col-md-6">
                <label class="form-control-label">Confirmar Contraseña</label>
                <input id="contrasena2"  type="text" class="form-control @error('contrasena2') is-invalid @enderror" name="contrasena2">
                @error('contrasena2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if (session('error'))
                <div class="alert alert-danger">
                {{ session('error') }}
                </div>
            @endif
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary botonCambiar">{{ __('Cambiar') }}</button>

        </div>
    </form></center>
</div>
<script>
    var contrasena1 = document.getElementById('contrasena');
    var contra2 = document.getElementById('contrasena2');
    console.log(contrasena1);
    console.log(contra2);



    if (contrasena1 === contra2){
        const button = document.getElementsByClassName("botonCambiar")
        const form = document.getElementsByClassName('formularioCambiar')
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
    }

</script>
@endsection
