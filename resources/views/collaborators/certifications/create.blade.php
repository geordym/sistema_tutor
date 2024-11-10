@extends('adminlte::page')

@section('title', 'Expedir certificados')

@section('content_header')
<h1></h1>
@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                <h2 class="text-center mb-4">Expedir certificados</h2>
            </div>

            <form action="{{ route('collaborators.certification.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="course">Curso:</label>
                    <select class="form-control" id="course" name="course" required>
                        <option value="" disabled selected>Seleccione un curso</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label>Selecciona los alumnos</label>



                <select multiple="multiple" id="select_alumns" name="alumnos[]">
                    @foreach($alumns as $alumno)
                    <option value="{{ $alumno->id }}">{{ $alumno->fullname }}</option>
                    @endforeach
                </select>

                <button class="btn btn-primary">EXPEDIR</button>
            </form>
        </div>
    </div>
</div>

<script>
    let select = document.querySelector("#select_alumns");
    let dualListbox = new DualListbox(select, {
        availableTitle: "Lista de alumnos",
        selectedTitle: "Alumnos a certificar",
    });
    dualListbox.add_button.classList.add("btn", "bg-primary"); // Botón de agregar
    dualListbox.add_all_button.classList.add("btn", "bg-success"); // Botón de agregar todos
    dualListbox.remove_button.classList.add("btn", "bg-info"); // Botón de quitar
    dualListbox.remove_all_button.classList.add("btn", "bg-danger"); // Botón de quitar todos


    dualListbox.add_button.textContent = "Agregar";
    dualListbox.add_all_button.textContent = "Agregar todos";
    dualListbox.remove_button.textContent = "Quitar";
    dualListbox.remove_all_button.textContent = "Quitar todos";

</script>

@stop