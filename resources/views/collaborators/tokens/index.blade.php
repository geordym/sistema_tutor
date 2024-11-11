@extends('adminlte::page')

@section('title', 'Dashboard Administración')

@section('content_header')
    <h1>Tokens </h1>
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

    </div>
   
    <div class="row bg-white mt-3">
    <div class="container mt-4">
    <h2 class="text-center mb-4">Registro de Tokens</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Operación</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha de Operación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tokensLogs as $token)
            <tr>
                <td>
                    @if($token->type === 'addition')
                        <span class="badge badge-success">Adición</span>
                    @else
                        <span class="badge badge-danger">Deducción</span>
                    @endif
                </td>
                <td>{{ $token->tokens }}</td>
                <td>{{ $token->description ?? 'N/A' }}</td>
                <td>{{ $token->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>









@stop