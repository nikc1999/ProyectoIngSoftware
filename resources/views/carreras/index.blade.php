@extends('layouts.app')

@section('content')

<div class="container">
    <p align="right"><a href="/agregarcarrera" class="btn btn-primary" role="button" data-bs-toggle="button">Nueva carrera</a></p>
</div>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="/agregarcarrera" class="btn btn-primary" role="button" data-bs-toggle="button">Nueva carrera</a>
  </div>

<div class="container col-md-8 col-md-offset-2">
        <div class="panel-heading">
            <h2>Gestionar Carreras</h2>
        </div>
        @if ($carrera->isEmpty())
            <div>No hay Mensajes</div>
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
                            <td><a href="/agregarcarrera" class="btn btn-primary" role="button" data-bs-toggle="button">Nueva carrera</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
