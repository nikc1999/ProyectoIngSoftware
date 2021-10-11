@extends('layouts.app')

@section('content')
@if (Auth::user()->rol == 'Administrador') <!-- aqui va el rol del cual queremos que el usuario tenga acceso  -->


<div>
    view de ejemplo
</div>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif




@endsection
