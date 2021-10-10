@extends('layouts.app')

@section('content')

<select class="form-select" aria-label="Default select example">
    <option selected>Seleccione una Carrera</option>
    @foreach($carrera as $car)
    <option value='{{$car->id}}'>{{$car->nombre}}</option>
    @endforeach
</select>


@endsection
