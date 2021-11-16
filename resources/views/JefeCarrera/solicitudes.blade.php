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
                <option >Seleccione tipo de filtro</option>
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

        <div hidden id="groupButton" class="col-lg-12 py-3">
            <div class="col-lg-12 text-center">
                <button style="color:white; background-color:rgb(0,181,226)" type="submit" id="boton" class="btn">Filtrar</button>
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
            <table class="table">
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
                            @if ($solicitudes[$i]->estado == 'Anulada' || $solicitudes[$i]->estado == 'Aceptada')
                                <td>No editable</td>
                                <td>No disponible</td>
                            @else
                                <td><a class="btn btn-outline-rgb" style="color:white; background-color:rgb(0,181,226)" href={{ route('solicitud.show', [$solicitudes[$i]]) }}>Detalles</a></td>
                            @endif
                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    </div>
</div>
<br>

<script type="text/javascript">
    const selectTipoFiltro = document.getElementById('tipo');
    const inputNumeroSolicitud = document.getElementById('groupNumeroSolicitud');
    const selectTipoSolicitud = document.getElementById('groupTipoSolicitud');
    const botton =  document.getElementById('groupButton');

    selectTipoFiltro.addEventListener('change', () => {
        switch (selectTipoFiltro.value) {
            case "Numero Solicitud":
                inputNumeroSolicitud.hidden = false;
                selectTipoSolicitud.hidden = true;
                botton.hidden = false;

                break;
            case "Tipo Solicitud":
                inputNumeroSolicitud.hidden = true;
                selectTipoSolicitud.hidden = false;
                botton.hidden = false;
                break;
        }
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
