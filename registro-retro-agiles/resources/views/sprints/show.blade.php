<!DOCTYPE html>
<html>
<head>
    <title>Detalle Sprint</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        {{-- Título del sprint --}}
        <h1>{{ $sprint->nombre }}</h1>
        <p>Inicio: {{ $sprint->fecha_inicio }} | Fin: {{ $sprint->fecha_fin }}</p>

        {{-- Botones de acción --}}
        <div style="margin-bottom: 20px;">
            <a href="{{ route('sprints.retro-items.create', $sprint->id) }}" class="btn-create">
                Añadir Ítem
            </a>

            {{-- Botón Importar Acciones --}}
            <form method="POST" action="{{ route('retro-items.importar', $sprint->id) }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-import">Importar acciones del sprint anterior</button>
            </form>
        </div>

        {{-- Mensajes flash --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        {{-- Lista de ítems de retrospectiva --}}
        <div class="retro-items">
            @forelse($retroItems as $item)
                <div class="item">
                    <h3>{{ ucfirst($item->categoria) }}</h3>
                    <p>{{ $item->descripcion }}</p>

                    @if($item->fecha_revision)
                        <small>Revisión: {{ $item->fecha_revision }}</small>
                    @endif

                    {{-- Botones de eliminar y editar --}}
                    <form method="POST" action="{{ route('retro-items.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Eliminar</button>
                        <a href="{{ route('retro-items.edit', $item->id) }}" class="btn-edit">Editar</a>
                    </form>
                </div>
            @empty
                <p>No hay ítems registrados para este sprint.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
