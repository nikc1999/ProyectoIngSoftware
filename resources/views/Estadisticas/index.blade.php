@extends('layouts.app')

@section('content')

<div class="container">
    <form method="GET" action="{{route('filtrarEstadistica')}}">

        <input id="fecha_inicio" name="fecha_inicio" value= "{{old('fecha_inicio')}}" type="date" class="@error('fecha_inicio') is-invalid @enderror"name="fecha_inicio">
        <input id="fecha_fin" name="fecha_fin" value= "{{old('fecha_fin')}}" type="date" class=" @error('fecha_fin') is-invalid @enderror"name="fecha_fin">
        @error('fecha_inicio')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
        <button style="color:white; background-color:rgb(188,97,36)" data-toggle="tooltip" data-placement="right" title="Actualiza las estadísticas para las solicitudes que están entre las fechas seleccionadas en los parametros anteriores, si no se selecciona fecha se colocara la fecha actual" class="btn">Filtrar Fecha</button>
        <a href={{ route('estadistica')}}><button style="color:white; background-color:rgb(188,97,36)" class="btn" type="button">Mostrar todo</button></a>
    </form>


    <br>


    <h1 style="font-size: 50px" class="text-center">Estadísticas del sistema</h1>
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div id="chartContainerTipo" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div id="chartContainerStatus" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div id="chartContainerFecha" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

    var chart = new CanvasJS.Chart("chartContainerTipo", {
    animationEnabled: true,
    theme: "light1", // "light1", "light2", "dark1", "dark2"
    title:{
    text: "Solicitudes por tipo"
    },
    axisY: {
    title: "Cantidad de solicitudes"
    },
    data: [{
    type: "column",
    showInLegend: false,
    legendMarkerColor: "grey",
    legendText: "MMbbl = one million barrels",
    dataPoints: [
    { y: JSON.parse("{{json_encode($cantTipoSobrecupo)}}"), label: "Sobrecupo" },
    { y: JSON.parse("{{json_encode($cantTipoCambioParalelo)}}"), label: "Cambio" },
    { y: JSON.parse("{{json_encode($cantTipoEliminarAsignatura)}}"), label: "Eliminación" },
    { y: JSON.parse("{{json_encode($cantTipoInscripcionAsignatura)}}"), label: "Inscripción" },
    { y: JSON.parse("{{json_encode($cantTipoAyudantia)}}"), label: "Ayudantía" },
    { y: JSON.parse("{{json_encode($cantTipoFacilidad)}}"), label: "Facilidades" },
    ]
    }]
    });
    var chart2 = new CanvasJS.Chart("chartContainerStatus", {
    animationEnabled: true,
    title:{
    text: "Solicitudes por estado",
    horizontalAlign: "center"
    },
    data: [{
    type: "doughnut",
    startAngle: 60,
    innerRadius: 50,
    indexLabelFontSize: 12,
    indexLabel: "{label} - #percent%",
    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
    dataPoints: [
    { y: JSON.parse("{{json_encode($totalPendiente)}}"), label: "Pendiente" },
    { y: JSON.parse("{{json_encode($totalRechazada)}}"), label: "Rechazada" },
    { y: JSON.parse("{{json_encode($totalAceptada)}}"), label: "Aceptada" },
    { y: JSON.parse("{{json_encode($totalAceptadaObs)}}"), label: "Aceptada con obs." },
    { y: JSON.parse("{{json_encode($totalAnulada)}}"), label: "Anulada" },
    ]
    }]
    });



    var chart3 = new CanvasJS.Chart("chartContainerFecha", {
    animationEnabled: true,
    theme: "light1", // "light1", "light2", "dark1", "dark2"
    title:{
    text: "Rango fecha"
    },
    axisY: {
    title: "Cantidad de solicitudes"
    },
    data: [{
    type: "column",
    showInLegend: false,
    legendMarkerColor: "grey",
    legendText: "MMbbl = one million barrels",
    dataPoints: [
    { y: JSON.parse("{{json_encode($cantEnRango)}}"), label: "Rango" },
    ]
    }]
    });
    chart.render();
    chart2.render();
    chart3.render();


</script>

@endsection
