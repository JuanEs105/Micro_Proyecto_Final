<!DOCTYPE html>
<html>
<head>
    <title>Añadir Ítem</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Añadir Ítem al Sprint: {{ $sprint->nombre }}</h1>

        {{-- Mensajes de error si existen --}}
        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('sprints.retro-items.store', $sprint->id) }}">
            @csrf

            {{-- Selección de categoría --}}
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select name="categoria" class="form-control" id="categoria" required>
                    <option value="positivo">Positivo (Lo que funcionó bien)</option>
                    <option value="negativo">Negativo (Lo que debe mejorar)</option>
                    <option value="accion">Acción (Compromisos para el próximo sprint)</option>
                </select>
            </div>
            
            {{-- Campo de descripción --}}
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" rows="3" id="descripcion" required></textarea>
            </div>
            
            {{-- Fecha de revisión --}}
            <div class="form-group">
                <label for="fecha_revision">Fecha de Revisión (solo para acciones):</label>
                <input type="date" name="fecha_revision" class="form-control" id="fecha_revision">
            </div>
            
            <button type="submit" class="btn-create">Guardar</button>
        </form>
    </div>
</body>
</html>
