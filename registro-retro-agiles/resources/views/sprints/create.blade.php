<!DOCTYPE html>
<html>
<head>
    <title>Crear Sprint</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Crear Sprint</h1>
        <form method="POST" action="/sprints">
            @csrf <!-- Token de seguridad -->
            <div class="form-group">
                <label>Nombre del Sprint:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label>Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label>Fecha de Fin:</label>
                <input type="date" name="fecha_fin" required>
            </div>
            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>