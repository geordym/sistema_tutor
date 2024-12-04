@extends('components.master')

@section('title', '¡Gracias por tu pago!')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-success text-white">
                        <h4>¡Gracias por tu pago!</h4>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead">Tu pago ha sido recibido con éxito. El tutor será notificado sobre la cita que has agendado. Estás un paso más cerca de tu clase.</p>

                        <div class="mt-4">
                            <p><strong>Detalles de la cita:</strong></p>
                            <p>Fecha: <span class="font-weight-bold">{{ $cita->fecha }}</span></p>
                            <p>Hora: <span class="font-weight-bold">{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</span></p>
                            <p>Con: <span class="font-weight-bold">{{ $tutor->nombre }}</span></p>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted">Recibirás un recordatorio antes de tu clase. Si tienes alguna pregunta, no dudes en contactarnos.</p>
                            <a href="/" class="btn btn-primary">Volver al inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
