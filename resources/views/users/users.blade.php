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
        <h1>Colaboradores</h1>

    </div>
    <div class="row">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
            Crear colaborador
        </button>
    </div>
    <div class="container mt-4">
    <h2 class="text-center mb-4">Lista de Colaboradores</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Tokens</th>
                <th scope="col">Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collaborators as $collaborator)
            <tr>
                <td>{{ $collaborator->id }}</td>
                <td>{{ $collaborator->name }}</td>
                <td>{{ $collaborator->user->email }}</td>
                <td>
                    <span class="badge {{ $collaborator->user->user_type === 'admin' ? 'badge-primary' : 'badge-secondary' }}">
                        {{ ucfirst($collaborator->user->user_type) }}
                    </span>
                </td>
                <td>{{ $collaborator->tokens }}</td>
                <td>{{ $collaborator->user->created_at->format('d/m/Y H:i') }}</td> 
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>




<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Crear colaborador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear colaborador</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
