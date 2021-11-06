@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Administrador')
<div class = "container">
        <div class="card">
    <center>
    <form id="formulario" class="formulariowo" method="POST" action="{{ route('carrera.update', [$carrera]) }}">
        @csrf
        @method('PUT')
        <br>
        <div class="col-md-2">
            <label>Codigo carrera: </label>
        </div>
        <div class="col-md-2">
            <label>  </label>
            <label>{!! $carrera->codigo !!}</label>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label class="form-control-label @error('nombre') is-invalid @enderror">Nuevo nombre:</label>
                <input id="nombre" type="text" value={{"$carrera->nombre"}} class="form-control" name="nombre" required>
                @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-info botonsito">{{ __('Editar') }}</button>
        </div>
        <br>
    </form></center>
</div>

<script>
    const button = document.getElementsByClassName('botonsito')
    const form = document.getElementsByClassName('formulariowo')
    for (let i = 0; i < button.length; i++) {
        button[i].addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Carrera editada',
          showConfirmButton: false,
          timer: 2000,
        })
        form[i].submit();
    })
    }

</script>


<br>
<div class = "container">
<center><a href="/gestionarcarreras"><button class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menu</button></a><center>
</div>
@else

@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
