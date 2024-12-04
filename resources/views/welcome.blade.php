@extends('components.master')

@section('title', 'Sistema Tutores')

@section('content')
    <div class="container">
        <!-- Sección Hero (introducción) -->
        <div class="row justify-content-center my-5">
            <div class="col-md-8 text-center">
                <h1 class="display-4 text-primary">Bienvenido a nuestro Sistema de Tutores y Estudiantes</h1>
                <p class="lead">¡Conéctate con tutores calificados y mejora tu aprendizaje, o comparte tu conocimiento y gana dinero! Regístrate ahora y comienza a disfrutar de nuestras ventajas.</p>
            </div>
        </div>

        <!-- Sección para Tutores -->
        <div class="row justify-content-center my-5">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h2 class="card-title">¿Eres Tutor?</h2>
                        <p>Comparte tus conocimientos y gana dinero en tus tiempos libres. Únete a nuestra red de tutores y ofrece clases a estudiantes de todo el mundo.</p>
                        <a href="{{ route('register.tutor') }}" class="btn btn-primary btn-lg">Regístrate aquí y empieza a enseñar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección para Estudiantes -->
        <div class="row justify-content-center my-5">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h2 class="card-title">¿Eres Estudiante?</h2>
                        <p>¿Buscas ayuda con tus asignaturas? Agenda clases con tutores expertos y mejora tu rendimiento académico. ¡Es fácil y rápido!</p>
                        <a href="{{ route('register.estudiante') }}" class="btn btn-success btn-lg">Regístrate aquí y encuentra un tutor</a>
                    </div>
                </div>
            </div>
        </div>

      

    </div> <!-- Fin del contenedor -->
@endsection
