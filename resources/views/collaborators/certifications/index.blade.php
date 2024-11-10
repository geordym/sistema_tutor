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
        <h1>Certificados</h1>

    </div>
    <div class="row">
        <a type="button" href="{{route('collaborators.certification.create')}}" class="btn btn-primary">
            Certificar
        </a>
    </div>

    <div class="container mt-4">
    <h2 class="text-center mb-4">Lista de Certificaciones expedidas</h2>
    
    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Tabla de certificaciones -->
    <table class="table table-striped table-hover table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Nombre del Alumno</th>
                <th scope="col">Curso</th>
                <th scope="col">Fecha de Expedición <i class="fas fa-calendar-alt"></i></th>
                <th scope="col">Acciones<i class="fas fa-calendar-alt"></i></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($certifications as $certification)
                <tr>
                    <td>{{ $certification->certify_code }}</td>
                    <td>{{ $certification->student_fullname }}</td>
                    <td>{{ $certification->course_name }}</td>
                    <td>{{ $certification->issue_date->format('d/m/Y') }}</td> 
                    <td>{{ $certification->issue_date->format('d/m/Y') }}</td> 
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-muted">No hay certificaciones disponibles</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</div>



@stop
