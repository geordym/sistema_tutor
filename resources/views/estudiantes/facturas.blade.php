@extends('components.master')

@section('title', 'Mis Facturas')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Mis Facturas</h1>

    @if (empty($facturas))
        <p class="text-center">No tienes facturas disponibles.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->fecha_emision }}</td>
                            <td>${{ number_format($factura->total, 2) }}</td>
                            <td>{{ ucfirst($factura->estado) }}</td>
                            <td>
                                <a href="{{ route('estudiantes.facturas_visualizar', $factura->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
