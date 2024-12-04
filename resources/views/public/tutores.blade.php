@extends('components.master')

@section('title', 'Ver tutores')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Tutores Disponibles</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($tutores as $tutor)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <!-- Imagen del tutor -->
                <div class="card-body">
                    <!-- Información del tutor -->
                    <h5 class="card-title">{{ $tutor->nombre }}</h5>
                    <p class="card-text">
                        <strong>Area:</strong> {{ $tutor->area_name ?? 'No especificada' }}<br>
                        <strong>Materia:</strong> {{ $tutor->materia_name ?? 'No especificada' }}<br>

                        <strong>Teléfono:</strong> {{ $tutor->telefono ?? 'No especificado' }}<br>
                        <strong>Costo por hora:</strong> ${{ number_format($tutor->costo_por_hora, 2) }}
                    </p>
                </div>
                <div class="card-footer text-center">
                    <!-- Botón para agendar clase -->
                    <a href="{{ route('agendar.tutor', $tutor->id) }}" class="btn btn-primary">Agendar Clase</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection