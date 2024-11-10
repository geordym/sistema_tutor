@extends('adminlte::page')

@section('title', 'Crear colaboradors')

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
        <h1>Alumnos</h1>

    </div>
    <div class="row">
        <a type="button" href="{{route('collaborators.alumns.create')}}" class="btn btn-primary">
            Registrar Alumno
        </a>

    </div>
    <div class="container mt-4">
    <h2 class="text-center mb-4">Lista de alumnos</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">CURP</th>
                <th scope="col">Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumns as $alumn)
            <tr>
                <td>{{ $alumn->id }}</td>
                <td>{{ $alumn->fullname }}</td>
                <td>{{ $alumn->curp }}</td>
                <td>{{ $alumn->created_at->format('d/m/Y H:i') }}</td> 
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>



@stop
