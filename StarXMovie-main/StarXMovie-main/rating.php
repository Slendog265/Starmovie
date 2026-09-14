<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Página de Rating de Película</title>
    <!-- Agrega la URL del CDN de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Agrega estilos personalizados aquí si es necesario */
        body {
            padding: 20px;
        }
        .movie-container {
            max-width: 400px;
            margin: 0 auto;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container movie-container">
    <h1 class="text-center">Página de Rating de Película</h1>

    <div class="card">
        <!-- Aquí puedes cambiar la URL de la imagen de la película -->
        <img id="movie-poster" class="card-img-top" alt="Película">

        <div class="card-body">
            <h5 class="card-title" id="movie-title">Título de la Película</h5>

            <form action="backend/php/valorar.php" method="post">
                <div class="mb-3">
                    <label for="rating" class="form-label">Tu Calificación (0-10):</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" step="0.1" required>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Dinos, que te parecio?:</label>
                    <input type="text" class="form-control" id="comentary" name="comentary" required>
                </div>
                <input type="hidden" name="pelicula_id" value="<?php echo htmlspecialchars($_GET['pelicula_id']); ?>">
            
                <button type="submit" class="btn btn-primary">Enviar Calificación</button>
            </form>
            
        </div>
    </div>
</div>

<!-- Agrega la URL del CDN de Bootstrap JavaScript (popper.js y jQuery son necesarios para algunos componentes) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const apiKey = '4ea50b45d21ada72083adff687e91dce';

        // Obtener el ID de la película de la URL
        const params = new URLSearchParams(window.location.search);
        const movieId = params.get('pelicula_id');

        // Verificar si el ID está presente en la URL
        if (!movieId) {
            console.error('ID de película no proporcionado en la URL.');
            return;
        }

        const apiUrl = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=es`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const posterPath = data.poster_path;
                const posterUrl = `https://image.tmdb.org/t/p/w500${posterPath}`;

                document.getElementById('movie-poster').src = posterUrl;
                document.getElementById('movie-title').textContent = data.title;
            })
            .catch(error => console.error('Error al obtener detalles de la película:', error));
    });
</script>
</body>
</html>
