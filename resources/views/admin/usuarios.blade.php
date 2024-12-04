@extends('adminlte::page')

@section('title', 'Dashboard Administración')

@section('content_header')
<h1>Usuarios</h1>
@stop

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



<div class="container mt-4">
    <h2 class="text-center mb-4">Lista de usuarios</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Habilitado</th>
                <th scope="col">Fecha de Creación</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->user_type }}</td>
                <td>{{ $usuario->habilitado ? 'Sí' : 'No' }}</td>
                <td>{{ $usuario->created_at}}</td>
                <td>
                    @if ($usuario->habilitado)
                    <a href="{{ route('admin.usuarios.desactivar', $usuario->id) }}" class="btn btn-danger">Desactivar usuario</a>
                    @else
                    <a href="{{ route('admin.usuarios.activar', $usuario->id) }}" class="btn btn-success">Activar usuario</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay usuarios registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>


@stop