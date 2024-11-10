@extends('adminlte::page')

@section('title', 'Expedir certificados')

@section('content_header')
<h1></h1>
@stop

@section('content')

<div class="container">

    <div class="container mt-4">
        <h2 class="text-center mb-4">Lista de certificados</h2>
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">CURP</th>
                    <th scope="col">Fecha de Creación</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certifications as $certify)
                <tr>
                    <td>{{ $certify->certify_code }}</td>
                    <td>{{ $certify->student_fullname }}</td>
                    <td>{{ $certify->student_curp }}</td>
                    <td>{{ $certify->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a class="btn btn-danger" href="{{$certify->getUrlPathAttribute()}}">Descargar Certificado</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop