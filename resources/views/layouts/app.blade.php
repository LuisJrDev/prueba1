<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Reservas')</title>

    <!-- Bootstrap (CDN para desarrollo rápido) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Archivos compilados por Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- Contenedor Principal -->
    <div class="container mt-4">

        <!-- Barra de Navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Actividades</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('activities.index') }}">Inicio</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido Dinámico -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap y Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
