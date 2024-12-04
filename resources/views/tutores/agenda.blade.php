@extends('adminlte::page')

@section('title', 'Crear Espacio')

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
        <h1>Espacios</h1>

    </div>
    <div class="row">
        <a type="button" href="{{route('tutor.createEspacio')}}" class="btn btn-primary">
            Registrar Espacio
        </a>



    </div>
    <div class="container mt-4">

        <div id="calendar" style="height: 800px"></div>

    </div>

</div>




@stop