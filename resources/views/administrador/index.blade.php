@extends('layouts.app')

@section('content')

<select class="form-select" aria-label="Default select example">
    <option selected>Seleccione una Carrera</option>
    @foreach($carrera as $car)
    <option value='{{$car->id}}'>{{$car->nombre}}</option>
    @endforeach
</select>

<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Gestionar Carreras</h2>
        </div>
        @if ($carrera->isEmpty())
            <div>No hay Carreras</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrera as $car)
                        <tr>
                            <td>{!! $car->codigo !!}</td>
                            <td>{!! $car->nombre !!}</td>
                            <td><a class="btn btn-info" href={{ route('editarcarrera', [$car]) }}>Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>



@endsection
