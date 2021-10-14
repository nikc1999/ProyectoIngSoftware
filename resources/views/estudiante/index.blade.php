@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Estudiante')
    <div><H1>SOY ESTUDIANTE</H1></div>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif
@endsection
