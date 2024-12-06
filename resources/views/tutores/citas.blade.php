@extends('adminlte::page')

@section('title', 'Ver mis citas')

@section('content_header')

@stop

@section('content')

<br>

<div class="container my-5">
    <h1 class="text-center mb-4">Mis Citas</h1>

    @if (empty($citas))
    <p class="text-center">No tienes citas agendadas.</p>
    @else
    <div class="list-group">
        @foreach ($citas as $cita)
        <div class="list-group-item">
            <h5>{{ $cita->nombre }} - {{ $cita->tipo }} </h5>
            <p><strong>Nombre del estudiante:</strong> {{ $cita->nombre }} </p>
            <p><strong>Telefono del estudiante:</strong> {{ $cita->telefono }} </p>
            <p><strong>Correo del estudiante:</strong> {{ $cita->correo }} </p>
            <p><strong>Fecha:</strong> {{ $cita->fecha }} </p>
            <p><strong>Hora:</strong> {{ $cita->hora_inicio }} - {{ $cita->hora_fin }} </p>
            <p><strong>Estado:</strong> {{ $cita->estado }}</p>
            <p><strong>Costo Total:</strong> {{ $cita->costo_total }} </p>
        </div>
        @endforeach
    </div>
    @endif

</div>


<br>
<br>
<br>

@endsection