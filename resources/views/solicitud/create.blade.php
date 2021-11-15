@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Estudiante')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="col-lg-12 login-title">
                <center>Nueva Solicitud<center>
            </div>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form id="formulario" method="POST" action="{{ route('solicitud.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="user" id="user" value={{Auth::user()->id}} hidden>
                        <div class="form-group">
                            <label for="form-control-label" style="color: black">Tipo Solicitud</label>
                            <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                                <option >Seleccione tipo de solicitud</option>
                                <option value="Sobrecupo">Sobrecupo</option>
                                <option value="Cambio paralelo">Cambio de Paralelo</option>
                                <option value="Eliminacion asignatura">Eliminación de Asignatura</option>
                                <option value="Inscripcion asignatura">Inscripción de Asignatura</option>
                                <option value="Ayudantia">Ayudantía</option>
                                <option value="Facilidades">Facilidades Académicas</option>
                            </select>
                            @error('tipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group" id="groupTelefono" hidden>
                            <label class="form-control-label">Teléfono de contacto</label>
                            <input id="telefono" type="text"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ old('telefono') }}" autocomplete="telefono" autofocus>

                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupNrc" hidden>
                            <label class="form-control-label">NRC asignatura</label>
                            <input id="nrc" type="text" class="form-control @error('nrc') is-invalid @enderror"
                                name="nrc" value="{{ old('nrc') }}" autocomplete="nrc" autofocus>

                            @error('nrc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupNombre" hidden>
                            <label class="form-control-label">Nombre asignatura</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus>

                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupDetalles" hidden>
                            <label class="form-control-label">Detalles de la solicitud</label>
                            <textarea id="detalle" type="text"
                                class="form-control @error('detalle') is-invalid @enderror" name="detalle"
                                value="{{ old('detalle') }}" autocomplete="detalle" autofocus></textarea>

                            @error('detalle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupCalificacion" hidden>
                            <label class="form-control-label">Calificación de aprobación</label>
                            <input id="calificacion" type="text"
                                class="form-control @error('calificacion') is-invalid @enderror" name="calificacion"
                                value="{{ old('calificacion') }}" autocomplete="calificacion" placeholder="Ej. 6.8"
                                autofocus>

                            @error('calificacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupCantidad" hidden>
                            <label class="form-control-label">Cantidad de ayudantias realizadas anteriormente</label>
                            <input id="cantidad" type="text"
                                class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                value="{{ old('cantidad') }}"
                                placeholder="Ej. 2, ingrese 0 en caso no haber realizado antes ayudantias"
                                autocomplete="cantidad" autofocus>

                            @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupTipoFacilidad" hidden>
                            <label for="form-control-label" style="color: white">Tipo de  facilidad académica</label>
                            <select class="form-control @error('facilidad') is-invalid @enderror" name="facilidad" id="facilidad">
                                <option value={{null}}>Seleccione una facilidad</option>
                                <option value="Licencia">Licencia Médica o Certificado Médico</option>
                                <option value="Inasistencia Fuerza Mayor">Inasistencia por Fuerza Mayor</option>
                                <option value="Representacion">Representación de la Universidad</option>
                                <option value="Inasistencia Motivo Personal">Inasistencia a Clases por Motivos Familiares</option>
                            </select>
                            @error('facilidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupProfesor" hidden>
                            <label class="form-control-label">Nombre profesor</label>
                            <input id="profesor" type="text"
                                class="form-control @error('profesor') is-invalid @enderror" name="profesor"
                                value="{{ old('profesor') }}" autocomplete="profesor" autofocus>

                            @error('profesor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupAdjunto" hidden>
                            <label class="form-control-label">Adjuntar archivos</label>
                            <input id="adjunto" type="file" class="form-control @error('adjunto') is-invalid @enderror"
                                name="adjunto[]" multiple>

                            @error('adjunto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div hidden id="groupButton" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="boton" class="btn btn-outline-primary">{{ __('Agregar')
                                    }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const selectSolicitud = document.getElementById('tipo');
    const inputTelefono = document.getElementById('groupTelefono');
    const inputNrc = document.getElementById('groupNrc');
    const inputNombre = document.getElementById('groupNombre');
    const inputDetalles = document.getElementById('groupDetalles');
    const inputCalificacion = document.getElementById('groupCalificacion');
    const inputCantidad = document.getElementById('groupCantidad');
    const inputTipoFacilidad = document.getElementById('groupTipoFacilidad');
    const inputProfesor = document.getElementById('groupProfesor');
    const inputAdjunto = document.getElementById('groupAdjunto');
    const button = document.getElementById('groupButton');
    selectSolicitud.addEventListener('change', () => {
        switch (selectSolicitud.value) {
            case "Sobrecupo":
                inputTelefono.hidden = false;
                inputNrc.hidden = false;
                inputNombre.hidden = false;
                inputDetalles.hidden = false;
                inputCalificacion.hidden = true;
                inputCantidad.hidden = true;
                inputTipoFacilidad.hidden = true;
                inputProfesor.hidden = true;
                inputAdjunto.hidden = true;
                button.hidden = false
                break;
            case "Cambio paralelo":
                inputTelefono.hidden = false;
                inputNrc.hidden = false;
                inputNombre.hidden = false;
                inputDetalles.hidden = false;
                inputCalificacion.hidden = true;
                inputCantidad.hidden = true;
                inputTipoFacilidad.hidden = true;
                inputProfesor.hidden = true;
                inputAdjunto.hidden = true;
                button.hidden = false
                break;
            case "Eliminacion asignatura":
                inputTelefono.hidden = false;
                inputNrc.hidden = false;
                inputNombre.hidden = false;
                inputDetalles.hidden = false;
                inputCalificacion.hidden = true;
                inputCantidad.hidden = true;
                inputTipoFacilidad.hidden = true;
                inputProfesor.hidden = true;
                inputAdjunto.hidden = true;
                button.hidden = false
                break;
            case "Inscripcion asignatura":
                inputTelefono.hidden = false;
                inputNrc.hidden = false;
                inputNombre.hidden = false;
                inputDetalles.hidden = false;
                inputCalificacion.hidden = true;
                inputCantidad.hidden = true;
                inputTipoFacilidad.hidden = true;
                inputProfesor.hidden = true;
                inputAdjunto.hidden = true;
                button.hidden = false
                break;
            case "Ayudantia":
                inputTelefono.hidden = false;
                inputNrc.hidden = true;
                inputNombre.hidden = false;
                inputDetalles.hidden = false;
                inputCalificacion.hidden = false;
                inputCantidad.hidden = false;
                inputTipoFacilidad.hidden = true;
                inputProfesor.hidden = true;
                inputAdjunto.hidden = true;
                button.hidden = false
                break;
            case "Facilidades":
                inputTelefono.hidden = false;
                inputNrc.hidden = true;
                inputNombre.hidden = false;
                inputDetalles.hidden = false;
                inputCalificacion.hidden = true;
                inputCantidad.hidden = true;
                inputTipoFacilidad.hidden = false;
                inputProfesor.hidden = false;
                inputAdjunto.hidden = false;
                button.hidden = false
                break;
            default:
                inputTelefono.hidden = true;
                inputNrc.hidden = true;
                inputNombre.hidden = true;
                inputDetalles.hidden = true;
                inputCalificacion.hidden = true;
                inputCantidad.hidden = true;
                inputTipoFacilidad.hidden = true;
                inputProfesor.hidden = true;
                inputAdjunto.hidden = true;
                button.hidden = true
                break;
        }
    })
</script>

<br>
<br>
<center><a href={{ route('solicitud.index')}}><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menu</button></a></center>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
