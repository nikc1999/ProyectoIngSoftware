@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Jefe de Carrera')
    <div><H1>Menú Jefe de Carrera</H1></div>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
