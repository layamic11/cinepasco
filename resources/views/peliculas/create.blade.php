<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Película - Cinepasco</title>
    <style>
        /* Unos estilos básicos y oscuros para que combine con tu panel */
        body { font-family: sans-serif; background-color: #111; color: white; padding: 50px; }
        .container { max-width: 600px; margin: auto; background: #222; padding: 30px; border-radius: 10px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border-radius: 5px; border: none; background: #333; color: white; }
        .btn-submit { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px; }
        .btn-submit:hover { background-color: #0056b3; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #ccc; text-decoration: none; }
        .btn-back:hover { color: white; }
    </style>
</head>
<body>

    <div class="container">
        <!-- Botón para regresar al panel anterior -->
        <a href="/" class="btn-back">⬅ Volver al Panel</a>

        <h2>🎬 Agregar Nueva Película</h2>
        <hr style="border-color: #444; margin-bottom: 20px;">

        <!-- El formulario que enviará los datos para guardar -->
        <form action="/peliculas" method="POST">
            <!-- Etiqueta de seguridad obligatoria de Laravel -->
            @csrf

            <div class="form-group">
                <label for="titulo">Título de la Película:</label>
                <input type="text" id="titulo" name="titulo" required placeholder="Ej: Avengers">
            </div>

            <div class="form-group">
                <label for="genero">Género:</label>
                <input type="text" id="genero" name="genero" required placeholder="Ej: Acción, Comedia">
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="cartelera">En Cartelera</option>
                    <option value="preventa">Preventa</option>
                    <option value="estrenos">Próximos Estrenos</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Guardar Película</button>
        </form>
    </div>

</body>
</html>