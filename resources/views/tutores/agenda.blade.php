@extends('adminlte::page')

@section('title', 'Crear Espacio')

@section('content_header')

@stop

@section('content')


<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="row">
        <h1>Espacios</h1>
    </div>
    <div class="row">
        <a type="button" href="{{route('tutor.createEspacio')}}" class="btn btn-primary">
            Registrar Espacio
        </a>
    </div>

    <!-- Tabla de espacios -->
    <div class="row mt-4">
        <h2>Espacios Registrados</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($espacios as $espacio) <!-- Recorriendo el array de espacios -->
                <tr>
                    <td>{{ $espacio->id }}</td>
                    <td>{{ $espacio->titulo }}</td>
                    <td>{{ $espacio->fecha }}</td>
                    <td>{{ $espacio->hora_inicio }}</td>
                    <td>{{ $espacio->hora_fin }}</td>

                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Calendario -->
    <div class="container mt-4">
        <div id="calendar" style="height: 800px"></div>
    </div>

</div>

@stop