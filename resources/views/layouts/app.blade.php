<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGLPWEB - Sistema de Gestión Legal</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Iconos de Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Estilos personalizados (opcional) --}}
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 col-lg-2 sidebar">
                <h4 class="text-center py-3">LegalPro</h4>
            @auth('web')
                <a href="{{ route('calendario.index') }}">
                    <i class="bi bi-calendar-week"></i> Calendario
                </a>
                <a href="{{ route('casos.index') }}">
                    <i class="bi bi-folder2-open"></i> Casos
                </a>
                <a href="{{ route('clientes.index') }}">
                    <i class="bi bi-person-fill"></i> Clientes
                </a>
                <a href="{{ route('usuarios.index') }}">
                    <i class="bi bi-person-fill"></i> Usuarios
                </a>
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link">Cerrar sesión usuario</button>
                </form>

            {{-- Si está autenticado como cliente --}}
            @elseif(Auth::guard('cliente')->check())
                <a href="{{ route('portal.index') }}">
                    <i class="bi bi-shield-lock-fill"></i> Portal Cliente
                </a>
                <form action="{{ route('cliente.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link">Cerrar sesión cliente</button>
                </form>

            {{-- Si no ha iniciado sesión en ningún guard --}}
            @else
                <a href="{{ route('user.login') }}">
                    <i class="bi bi-person"></i> Ingresar como Usuario
                </a>
                <a href="{{ route('cliente.login') }}">
                    <i class="bi bi-person-badge"></i> Ingresar como Cliente
                </a>
            @endauth
        </div>

        {{-- Contenido principal --}}
        <div class="col-md-9 col-lg-10 p-4">
            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
