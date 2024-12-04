@extends('adminlte::page')

@section('title', 'Crear Espacio')

@section('content_header')

@stop

@section('content')
<br>

<div class="container mt-4">
    <h2>Cambiar Imagen de Perfil</h2>

    <!-- Mostrar la imagen actual si existe -->
    <div class="mb-3">
        @if(auth()->user()->imagen_perfil)
            <p>Imagen de perfil actual:</p>
            <img src="{{ asset('storage/' . auth()->user()->imagen_perfil) }}" alt="Imagen de Perfil" class="img-thumbnail" style="width: 150px; height: 150px;">
        @else
            <p>No tienes una imagen de perfil actualmente.</p>
        @endif
    </div>

    <!-- Formulario para actualizar la imagen -->
    <form action="{{ route('user.updateProfileImage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="profile_image">Selecciona una nueva imagen de perfil:</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Actualizar Imagen</button>
    </form>
</div>



@stop