<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title> <!-- Título por defecto -->

    <!-- Incluir Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Barra de navegación con Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Mi Aplicación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Inicio</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.tutores') }}">Tutores</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.tutorias') }}">Tutorias</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#">Acerca de</a>
                    </li>

                    <li class="nav-item">
                        @if(auth()->check() && auth()->user()->user_type === 'estudiante')
                        <a class="nav-link" href="{{ route('estudiantes.citas') }}">Mis citas</a>

                        @endif


                    </li>

                    <li class="nav-item">
                        @if(auth()->check() && auth()->user()->user_type === 'estudiante')
                        <a class="nav-link" href="{{ route('estudiantes.facturas') }}">Mis Facturas</a>

                        @endif


                    </li>

                    @auth

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
                    </li>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido de la página -->
    <div class="container mt-4">
        @yield('content') <!-- Aquí se inyectará el contenido específico de la vista -->
    </div>

    <!-- Pie de página -->
    <footer class="mt-4">
        <div class="container text-center">
            <p>&copy; 2024 Mi Aplicación</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>