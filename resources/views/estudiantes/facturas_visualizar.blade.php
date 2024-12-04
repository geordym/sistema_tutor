@extends('components.master')

@section('title', 'Detalle de Factura')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Detalle de Factura</h1>

    @if (empty($factura))
    <p class="text-center">Factura no encontrada.</p>
    @else
    @php
    $factura = $factura[0]; // Selecciona la primera fila del resultado
    @endphp

    <div class="card">
        <div class="card-header">
            <h4>Factura ID: {{ $factura->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Fecha:</strong> {{ $factura->fecha_emision }}</p>
            <p><strong>Total:</strong> ${{ number_format($factura->total, 2) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($factura->estado) }}</p>
        </div>
    </div>

    @php
    $facturaItems = DB::select('SELECT * FROM facturas_items WHERE factura_id = ?', [$factura->id]);
    @endphp

    <h3 class="mt-4">Artículos de la Factura</h3>
    @if (empty($facturaItems))
    <p>No hay artículos en esta factura.</p>
    @else
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturaItems as $item)
                <tr>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 2) }}</td>
                    <td>${{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @endif
</div>
@endsection