@extends('adminlte::page')

@section('title', 'Crear Espacio')

@section('content_header')
<h1>Crear Espacio</h1>
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
        <h2 class="text-center mb-4">Selecciona el espacio para agendar</h2>
        <br>

        <!-- Formulario de selección de fecha y hora -->
        <form action="{{ route('espacios.store') }}" method="POST">
            @csrf

            <input type="hidden" name="tutor" id="tutor" value="{{$tutor->id}}">

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="hora_inicio">Hora de Inicio</label>
                <select class="form-control" id="hora_inicio" name="hora_inicio" required>
                    @for($i = 8; $i < 18; $i++) <!-- Aquí defines el rango de horas -->
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                        @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="hora_fin">Hora de Fin</label>
                <select class="form-control" id="hora_fin" name="hora_fin" required>
                    @for($i = 9; $i < 19; $i++) <!-- Las horas fin deben ser al menos una hora después -->
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                        @endfor
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Espacio</button>
        </form>
    </div>


    <div id="calendar"></div> <!-- El contenedor donde se renderizará el calendario -->

</div>


<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.css" rel="stylesheet">

<script>
  
</script>



@stop