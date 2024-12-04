@extends('components.master')

@section('title', 'Registrar Tutor')

@section('content')


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

<script>
    const areasMaterias = @json($areasMaterias);
</script>


<div class="container my-5">
    <h1 class="text-center mb-4">Registrar Tutor</h1>

    <form method="POST" action="{{ route('register.tutor.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Nombre del tutor -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Tutor</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <!-- Costo por hora -->
        <div class="mb-3">
            <label for="costo_por_hora" class="form-label">Costo por Hora</label>
            <input type="number" class="form-control" id="costo_por_hora" name="costo_por_hora" step="0.01" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <!-- Area -->
        <div class="mb-3">
            <label for="area" class="form-label">Area</label>
            <select id="area" name="area" class="form-control">
                <option value="">Selecciona una opción</option>
                @foreach ($areasMaterias->unique('area_id') as $area)
                <option value="{{ $area->area_id }}">{{ $area->area_nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="materia" class="form-label">Materia</label>
            <select id="materia" name="materia" class="form-control">
                <option value="">Selecciona una opción</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>

        <!-- Dirección -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrar Tutor</button>
    </form>



</div>



<script>
    // Actualiza las materias basadas en el área seleccionada
    document.getElementById('area').addEventListener('change', function() {
        console.log("Cambiado");
        const selectedAreaId = this.value;
        const materiaSelect = document.getElementById('materia');
        console.log(materiaSelect);

        materiaSelect.innerHTML = '<option value="">Selecciona una opción</option>';

        const filteredMaterias = areasMaterias.filter(item => item.area_id == selectedAreaId);
        console.log(filteredMaterias);

        filteredMaterias.forEach(item => {
            const option = document.createElement('option');
            option.value = item.materia_id;
            option.textContent = item.materia_nombre;
            materiaSelect.appendChild(option);
            console.log("Creando option");
            console.log(item);
        });
    });
</script>
@endsection