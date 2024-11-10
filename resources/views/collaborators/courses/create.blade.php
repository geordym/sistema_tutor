@extends('adminlte::page')

@section('title', 'Crear Curso')

@section('content_header')
    <h1></h1>
@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- Contenedor de ancho medio -->
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

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <h2 class="text-center mb-4">Formulario de Creación de Curso</h2>
            </div>

            <form action="{{ route('collaborators.courses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Curso:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="duration">Duración en Horas:</label>
                    <input type="number" class="form-control" id="duration" name="duration" min="1" required>
                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="{{ route('collaborators.courses.index') }}">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
