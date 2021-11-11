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
                <input id="contrasena"  type="password" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" >
                @error('contrasena')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="col-md-6">
                <label class="form-control-label">Confirmar Contraseña</label>
                <input id="contrasena2"  type="password" class="form-control @error('contrasena2') is-invalid @enderror" name="contrasena2">
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
    // siempre se ejecuta en todo momento

    const button = document.getElementsByClassName("botonCambiar")
    const form = document.getElementsByClassName('formularioCambiar')
    for (let i = 0; i < button.length; i++) {
        button[i].addEventListener('click', function(e){
        //aqui se activa todo al apretar el boton
        const contrasena1 = document.getElementById('contrasena').value;
        const contra2 = document.getElementById('contrasena2').value;
        //console.log(contrasena1);
        //console.log(contra2);
        if (contrasena1 == contra2 && contrasena1 != '' && contra2 != '' && contrasena1.length>=6 && contra2.length>=6 && contrasena1.isEmpty()) {
            e.preventDefault();
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Contraseña cambiada',
            showConfirmButton: false,
            timer: 2000,
        })
        }
        form[i].submit();
        })
    }

</script>


@endsection
