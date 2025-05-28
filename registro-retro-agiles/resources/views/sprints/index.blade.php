<!DOCTYPE html>
<html>
<head>
    <title>Sprints Registrados</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Menú de navegación -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('sprints.index') }}" class="nav-link">🏁 Sprints</a>
            <a href="{{ route('sprints.create') }}" class="nav-link">➕ Nuevo Sprint</a>
        </div>
    </nav>

    <div class="container">
        <h1>Sprints Registrados</h1>

        {{-- Mostrar mensaje de éxito --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Listado de sprints --}}
        @foreach($sprints as $sprint)
            <div class="sprint-item">
                <h3>{{ $sprint->nombre }}</h3>
                <p>Inicio: {{ $sprint->fecha_inicio }} | Fin: {{ $sprint->fecha_fin }}</p>
                <a href="{{ route('sprints.show', $sprint->id) }}" class="btn-create">Ver Detalles</a>
            </div>
        @endforeach
    </div>

</body>
</html>
