@extends('components.master')

@section('title', 'Ver tutores')

@section('content')
<!-- Agregar los enlaces de Bootstrap 4.5 -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .list-group-item {
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    ul {
        padding-left: 20px;
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-4">Tutores Disponibles</h1>

    <!-- Barra lateral (Sidebar) -->
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                @foreach ($areasList as $area)
                <!-- Área -->
                <div class="list-group-item">
                    <h5>
                        <!-- Botón para desplegar materias con dropdown -->
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#materias-{{ $area['nombre'] }}">
                            {{ $area['nombre'] }}
                        </button>
                    </h5>

                    <!-- Materias asociadas al área (ocultas por defecto) -->
                    <div class="collapse" id="materias-{{ $area['nombre'] }}">
                        <ul class="list-unstyled">
                            @foreach ($area['materias'] as $materia)
                            <li><a href="{{route('public.tutorias.porMateriaId', $materia['id'])}}" class="d-block">{{ $materia['nombre'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-9">
            <div class="list-group">
                @if (empty($tutores))
                <p class="text-muted">No hay tutores disponibles para esta materia.</p>
                @else

                
                @foreach ($tutores as $tutor)
                <a href="{{route('agendar.tutor', $tutor->id  )}}" class="list-group-item list-group-item-action">
                    {{ $tutor->user_name }}
                </a>
                @endforeach
                @endif
            </div>

        </div>

    </div>
</div>

@endsection