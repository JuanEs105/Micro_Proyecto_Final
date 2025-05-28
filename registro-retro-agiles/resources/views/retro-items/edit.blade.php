<!DOCTYPE html>
<html>
<head>
    <title>Editar Ítem</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Editar Ítem de la Retrospectiva</h1>

        {{-- Mensajes de error (opcional) --}}
        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('retro-items.update', $retroItem->id) }}">
            @csrf
            @method('PUT')

            {{-- Selección de categoría --}}
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select name="categoria" class="form-control" id="categoria" required>
                    <option value="positivo" {{ $retroItem->categoria == 'positivo' ? 'selected' : '' }}>Positivo</option>
                    <option value="negativo" {{ $retroItem->categoria == 'negativo' ? 'selected' : '' }}>Negativo</option>
                    <option value="accion" {{ $retroItem->categoria == 'accion' ? 'selected' : '' }}>Acción</option>
                </select>
            </div>

            {{-- Campo de descripción --}}
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" rows="3" id="descripcion" required>{{ $retroItem->descripcion }}</textarea>
            </div>

            {{-- Fecha de revisión (solo para acciones) --}}
            <div class="form-group">
                <label for="fecha_revision">Fecha de Revisión (solo para acciones):</label>
                <input type="date" name="fecha_revision" class="form-control" id="fecha_revision" value="{{ $retroItem->fecha_revision }}">
            </div>

            <button type="submit" class="btn-create">Actualizar</button>
        </form>
    </div>
</body>
</html>
