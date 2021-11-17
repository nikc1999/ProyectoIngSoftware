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
                <h2><center>Editar Solicitud<center></h2>
            </div>
            <br>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form id="formulario" method="POST" action="{{ route('solicitud.update',[$solicitud]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="text" name="user" id="user" value={{Auth::user()->id}} hidden>
                        <div class="form-group">
                            <label for="form-control-label" style="color: black">Tipo Solicitud</label>


                            <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                                @if (old('tipo') == null)
                                    <option value="Sobrecupo" @if ($solicitud->tipo == 'Sobrecupo') selected="selected" @endif>Sobrecupo</option>
                                    <option value="Cambio paralelo" @if ($solicitud->tipo == 'Cambio paralelo') selected="selected" @endif>Cambio de Paralelo</option>
                                    <option value="Eliminacion asignatura" @if ($solicitud->tipo == 'Eliminacion asignatura') selected="selected" @endif>Eliminación de Asignatura</option>
                                    <option value="Inscripcion asignatura" @if ($solicitud->tipo == 'Inscripcion asignatura') selected="selected" @endif>Inscripción de Asignatura</option>
                                    <option value="Ayudantia" @if ($solicitud->tipo == 'Ayudantia') selected="selected" @endif>Ayudantía</option>
                                    <option value= "Facilidades" @if ($solicitud->tipo == 'Facilidades') selected="selected" @endif>Facilidades Académicas</option>
                                @else
                                <option value="Sobrecupo" @if (old('tipo') == 'Sobrecupo') selected="selected" @endif>Sobrecupo</option>
                                <option value="Cambio paralelo" @if (old('tipo') == 'Cambio paralelo') selected="selected" @endif>Cambio de Paralelo</option>
                                <option value="Eliminacion asignatura" @if (old('tipo') == 'Eliminacion asignatura') selected="selected" @endif>Eliminación de Asignatura</option>
                                <option value="Inscripcion asignatura" @if (old('tipo') == 'Inscripcion asignatura') selected="selected" @endif>Inscripción de Asignatura</option>
                                <option value="Ayudantia" @if (old('tipo') == 'Ayudantia') selected="selected" @endif>Ayudantía</option>
                                <option value= "Facilidades" @if (old('tipo') == 'Facilidades') selected="selected" @endif>Facilidades Académicas</option>

                                @endif

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
                                value="{{ $solicitud->telefono }}" autocomplete="telefono" autofocus>

                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupNrc" hidden>
                            <label class="form-control-label">NRC asignatura</label>
                            <input id="nrc" type="text" class="form-control @error('nrc') is-invalid @enderror"
                                name="nrc" value="{{ $solicitud->NRC }}" autocomplete="nrc" autofocus>

                            @error('nrc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupNombre" hidden>
                            <label class="form-control-label">Nombre asignatura</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ $solicitud->nombre_asignatura }}" autocomplete="nombre" autofocus>

                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupDetalles" hidden>
                            <label class="form-control-label">Detalles de la solicitud</label>
                            <textarea maxlength=500 id="detalle" type="text"
                                class="form-control @error('detalle') is-invalid @enderror" name="detalle"
                                autocomplete="detalle" autofocus>{{ $solicitud->detalles_estudiante }}</textarea>
                                <div id="count">
                                    <span id="current_count">{{ Str::length($solicitud->detalles_estudiante) }}</span>
                                    <span id="maximum_count">/ 500</span>
                                </div>

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
                                value="{{ $solicitud->calificacion_aprob }}" autocomplete="calificacion" placeholder="Ej. 6.8"
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
                                value="{{ $solicitud->cant_ayudantias }}"
                                placeholder="Ej. 2, ingrese 0 en caso no haber realizado antes ayudantias"
                                autocomplete="cantidad" autofocus>

                            @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupTipoFacilidad" hidden>
                            <label for="form-control-label">Tipo de  facilidad académica</label>
                            <select class="form-control @error('facilidad') is-invalid @enderror" name="facilidad" id="facilidad">
                                <option value={{null}}>Seleccione una facilidad</option>
                                <option value="Licencia" @if ($solicitud->tipo_facilidad == 'Licencia') selected="selected" @endif>Licencia Médica o Certificado Médico</option>
                                <option value="Inasistencia Fuerza Mayor" @if ($solicitud->tipo_facilidad  == 'Inasistencia Fuerza Mayor') selected="selected" @endif>Inasistencia por Fuerza Mayor</option>
                                <option value="Representacion" @if ($solicitud->tipo_facilidad  == 'Representacion') selected="selected" @endif>Representación de la Universidad</option>
                                <option value="Inasistencia Motivo Personal" @if ($solicitud->tipo_facilidad == 'Inasistencia Motivo Personal') selected="selected" @endif>Inasistencia a Clases por Motivos Familiares</option>
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
                                value="{{ $solicitud->nombre_profesor }}" autocomplete="profesor" autofocus>

                            @error('profesor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupAdjunto" hidden>

                            @if(is_null($solicitud->archivos))
                                <div>
                                    <label class="form-control-label">Adjuntar archivos (hasta 3 archivos, máximo de 20Mb por archivo)</label>
                                    <input id="adjunto" type="file" class="form-control @error('adjunto[]') is-invalid @enderror" name="adjunto[]" multiple>
                                    <br>
                                    @if ($errors->has('adjunto.0'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('adjunto.0')}}
                                        </div>
                                    @endif

                                    @if ($errors->has('adjunto.1'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('adjunto.1')}}
                                        </div>
                                    @endif
                                    @if ($errors->has('adjunto.2'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('adjunto.2')}}
                                        </div>
                                    @endif

                                    @error('adjunto')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @else
                                <label class="form-control-label">Editar archivos adjuntos</label>

                                <select class="form-control @error('archivo') is-invalid @enderror" name="archivo" id="archivo">
                                    <option value={{null}}>Seleccione una opcion</option>
                                    <option value= "0" >Guardar archivos anteriores</option>
                                    <option value= "1" >Cambiar archivos</option>
                                </select>
                                <br>

                                <div id="groupAdj" hidden>
                                    <label class="form-control-label">Adjuntar archivos (hasta 3 archivos, máximo de 20Mb por archivo)</label>
                                    <input id="adjunto" type="file" class="form-control @error('adjunto[]') is-invalid @enderror" name="adjunto[]" multiple>
                                    <br>
                                    @if ($errors->has('adjunto.0'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('adjunto.0')}}
                                        </div>
                                    @endif

                                    @if ($errors->has('adjunto.1'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('adjunto.1')}}
                                        </div>
                                    @endif
                                    @if ($errors->has('adjunto.2'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('adjunto.2')}}
                                        </div>
                                    @endif

                                    @error('adjunto')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @if(!is_null($solicitud->archivos))
                                    <label class="form-control-label">Los archivos anteriores son los siguientes:</label>
                                    <br>
                                    @php
                                    $i = 1
                                    @endphp
                                    @foreach (json_decode($solicitud->archivos) as $link)
                                    <a href="http://localhost:8000/storage/docs/{{$link}}">Archivo {{$i++}}</a>
                                    @endforeach

                                @endif

                            @endif


                        </div>


                        <div hidden id="groupButton" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="boton" class="btn">Editar</button>
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
    //mostrarAlInicio{
    //  obtenerSeleccionado
    //  mostrar(ObtenerSeleccionado)
    // }
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
    const adjArchivo = document.getElementById('groupAdj');
    const selectArchivo = document.getElementById('archivo');



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

    selectArchivo.addEventListener('change', () => {
        switch (selectArchivo.value) {
            case "0":
                adjArchivo.hidden=true;
                break;
            case "1":
                adjArchivo.hidden=false;
                break;
            default:
                adjArchivo.hidden=true;
                break;
        }
    })
</script>

<script>
    const button_enviar = document.getElementById('boton');
    button_enviar.addEventListener('click', function(e){
        var input_archivos = document.getElementById("adjunto");
        for (var i = 0; i < input_archivos.size; i++) {
            let size = input_archivos.files[i].size;
            if (size > 20000000) {
                let index = i+1;
                alert("el archivo "+index+" pesa más de 20Mb");
                event.preventDefault();
            }
        }
    })
</script>

<script type="text/javascript">
    const textarea_detalle = document.getElementById('detalle');
    textarea_detalle.addEventListener('keyup', function() {
        var characterCount = $(this).val().length,
            current_count = $('#current_count'),
            maximum_count = $('#maximum_count'),
            count = $('#count');
            current_count.text(characterCount);
    });
</script>

<br>
<br>
<center><a href={{ route('solicitud.index')}}><button style="color:white; background-color:rgb(0,48,87)" class="btn btn-info" type="button">Volver</button></a>
<a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
