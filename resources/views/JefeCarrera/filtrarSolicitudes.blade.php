@extends('layouts.app')

@section('content')
@if (Auth::user()->rol=='Jefe de Carrera')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Panel de Solicitudes</h2>
        </div>
        <br>


        <div class="form-group">
            <label for="form-control-label" style="color: black">Filtrar Solicitud Por:</label>
            <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                <option value = "Defecto">Seleccione tipo de filtro</option>
                <option value="Numero Solicitud">Numero Solicitud</option>
                <option value="Tipo Solicitud">Tipo Solicitud</option>
            </select>
            @error('tipo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group" id="groupNumeroSolicitud" hidden>
            <label class="form-control-label">Numero Solicitud</label>
            <input id="numeroSolicitud" type="text"
                class="form-control @error('telefono') is-invalid @enderror" name="numeroSolicitud"
                value="{{ old('telefono') }}" autocomplete="telefono" autofocus>

            @error('telefono')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group" id= "groupTipoSolicitud" hidden>
            <label for="form-control-label" style="color: black">Filtrar Solicitud Por:</label>
            <select class="form-control @error('tipoSolicitud') is-invalid @enderror" name="tipoSolicitud" id="tipoSolicitud">
                <option >Seleccione tipo de Solicitud</option>
                <option value="Sobrecupo">Sobrecupo</option>
                <option value="Cambio Paralelo">Cambio De Paralelo</option>
                <option value="Eliminacion asignatura">Eliminacion Asignatura</option>
                <option value="Inscripcion asignatura">Inscripcion De Asignatura</option>
                <option value="Ayudantia">Solicitud Ayudantia</option>
                <option value="Facilidades">Facilidad Academica</option>
            </select>
            @error('tipoSolicitud')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div hidden id="groupButtonNumero" class="col-lg-12 py-3">
            <div class="col-lg-12 text-center">
                <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="botonNumero" class="btn">Filtrar</button>
            </div>
        </div>

        <div hidden id="groupButtonTipo" class="col-lg-12 py-3">
            <div class="col-lg-12 text-center">
                <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="botonTipo" class="btn">Filtrar</button>
            </div>
        </div>
        <br>

        @if ($solicitudes->isEmpty())
        <br>
        <br>
        <div class="alert alert-danger" role="alert">
            No existen solicitudes pendientes
        </div>
        @else
        <br>
            <table class="table" id="TablaFiltradaTipo" hidden>
                <thead>
                    <tr>
                        <th>N° SOLICITUD</th>
                        <th>TIPO SOLICITUD</th>
                        <th>FECHA SOLICITUD</th>
                        <th>RUT ESTUDIANTE</th>
                        <th>NOMBRE ESTUDIANTE</th>
                        <th>RESOLVER</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < count($solicitudes) ; $i++  )
                        <tr>
                            <td>{!! $solicitudes[$i]->id !!}</td>
                            @if($solicitudes[$i]->tipo == 'Facilidades')
                                <td>{!! $solicitudes[$i]->tipo !!}: {!! $solicitudes[$i]->tipo_facilidad !!}</td>
                            @else
                                <td>{!! $solicitudes[$i]->tipo !!}</td>
                            @endif
                            <td>{!! $solicitudes[$i]->updated_at !!}</td>
                            <td>{!! $datosEstudiantes[$i][0] !!}</td>
                            <td>{!! $datosEstudiantes[$i][1] !!}</td>
                            <td><a class="btn btn-outline-rgb" style="color:white; background-color:rgb(0,181,226)" href={{ route('solicitud.show', [$solicitudes[$i]]) }}>Detalles</a></td>

                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    </div>
</div>


<script type="text/javascript">
    const selectTipoFiltro = document.getElementById('tipo');
    const inputNumeroSolicitud = document.getElementById('groupNumeroSolicitud');
    const selectTipoSolicitud = document.getElementById('groupTipoSolicitud');
    const bottonNumero =  document.getElementById('groupButtonNumero');
    const bottonTipo =  document.getElementById('groupButtonTipo');

    const tablaFiltrada =  document.getElementById('TablaFiltradaTipo');


    selectTipoFiltro.addEventListener('change', () => {
        switch (selectTipoFiltro.value) {
            case "Defecto":
                inputNumeroSolicitud.hidden = true;
                selectTipoSolicitud.hidden = true;
                bottonNumero.hidden = true;
                bottonTipo.hidden = true;
                tablaFiltrada.hidden = true;
            case "Numero Solicitud":
                inputNumeroSolicitud.hidden = false;
                selectTipoSolicitud.hidden = true;
                bottonNumero.hidden = false;
                bottonTipo.hidden = true;
                tablaFiltrada.hidden = true;


                break;
            case "Tipo Solicitud":
                inputNumeroSolicitud.hidden = true;
                selectTipoSolicitud.hidden = false;
                bottonNumero.hidden = true;
                bottonTipo.hidden = false;

                break;
        }
    })
</script>

<script>
    const button_filtrar_numero = document.getElementById('botonNumero');
    button_filtrar_numero.addEventListener('click', function(e){

        //si el numero de solicitud ingresado no existe mostrar error:   “El número de la solicitud no existe”
        //si el numero de solicitud si existe se tiene que rederigir de inmediato a la vista para aceptar o rechazar solicitud, osea
        //la misma vista a la cual deberia llevar el boton Resolver

    })
</script>

<script>
    const button_filtrar_tipo = document.getElementById('botonTipo');

    button_filtrar_tipo.addEventListener('click', function(e){

        tablaFiltrada.hidden = false;



    })
</script>

<center><a href="{{ route('home') }}"><button class="btn btn-dark" type="button">Volver Menú</button></a></center>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
