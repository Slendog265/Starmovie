<?php
session_start();
$datos = json_decode($_SESSION["usuario_activo"], false);
include("backend/php/dol/person.php");
$prueba = new Person();

// Use the correct method call to get the movie ids
$movieIds = $prueba->getMovieIds();
$averages = $prueba->getAverages();
$it = 0;
$i=0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reseñas de Películas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        
    <!-- Agregar Bootstrap JS, jQuery y Popper.js -->
    <link href="frontend/css/pagina principal style.css" rel="stylesheet">
    
    </head>
<body>

    <div class="modal">
        <img src="" alt="Imagen Ampliada">
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container-fluid">

            <a class="navbar-brand" href="pagina principal.php">
                <img class="rounded-image" src="frontend/image/Logo.png" alt="NexoWeb">
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mynavbar">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="acerca de.html">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="top.php">top 5</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="text" id="search-input" placeholder="Buscar">
                    <button class="btn btn-primary me-2" id="search-button" type="button">Buscar</button>
                </form>
            </div>

        </div>

    </nav>


    <div class="container-fluid mt-4">
        
    <!-- Carrusel de Películas Destacadas -->
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <?php
foreach ($movieIds as $movieId) {
    // Fetch movie details from TMDb API
    $api_key = '4ea50b45d21ada72083adff687e91dce';
    $api_url = "https://api.themoviedb.org/3/movie/{$movieId}?api_key={$api_key}&language=en-US";
    $movie_data = json_decode(file_get_contents($api_url));

    echo '<a href="detalle pelicula.php?id=' . $movieId . '">
            <div class="carousel-item';
    // La primera película debe tener la clase 'active'
    echo ($i === 0) ? ' active' : '';
    echo '">
                <img src="https://image.tmdb.org/t/p/w780' . $movie_data->poster_path . '" class="d-block w-100" alt="' . $movie_data->original_title . '">
                <div class="carousel-caption">
                    <h3>' . $movie_data->original_title . '</h3>
                </div>
            </div>
        </a>';

    $i++;
    // Mostrar solo tres películas
    if ($i === 3) {
        break;
    }
}
$i=0;
?>

                <!--<div class="carousel-item active">
                    <img src="frontend/image/Scarface.jpg" class="d-block w-100" alt="Scarface">
                    <div class="carousel-caption">
                        <h3>Scarface</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="frontend/image/The Godfather.jpg" class="d-block w-100" alt="The Godfather">
                    <div class="carousel-caption">
                        <h3>The Godfather</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="frontend/image/LA LA LAND.jpg" class="d-block w-100" alt="LA LA LAND">
                    <div class="carousel-caption">
                        <h3>LA LA LAND</h3>
                    </div>
                </div>-->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" ariahidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Agrega este div para contener los resultados de la búsqueda -->
    <div id="searchResultsContainer" class="row mt-4"></div>

    <?php
// Iterate through each movie ID
foreach ($movieIds as $movieId) {
    // Fetch movie details from TMDb API
    $api_key = '4ea50b45d21ada72083adff687e91dce';
    $api_url = "https://api.themoviedb.org/3/movie/{$movieId}?api_key={$api_key}&language=en-US";
    $movie_data = json_decode(file_get_contents($api_url));

    // Output movie details in the specified format
    if ($it % 4 == 0 || $it == 0) {
        echo '<div class="mt-4"></div>';
        echo '<div class="row">';
    }

    echo '<div class="col-md-3">';
    echo '<div class="movie-card" onclick="window.location.href=\'detalle pelicula.php?id=' . $movieId . '\'">';
    echo '<img src="https://image.tmdb.org/t/p/w500' . $movie_data->poster_path . '" class="img-fluid" alt="' . $movie_data->original_title . '">';
    echo '<h2>' . $movie_data->original_title . '</h2>';
    // echo '<p>Director: ' . $movie_data->director . '</p>';
    echo '<p>Puntuación: <span class="puntuacion">' . $averages[$i] . '</span></p>';
    echo '</div>';
    echo '</div>';

    if (($it + 1) % 4 == 0) {
        echo '</div>';
    }

    $it = $it + 1;
    $i++;
}

// Close the row div if the number of movies is not a multiple of 4
if ($it % 4 != 0) {
    echo '</div>';
}
?>
    </div>
    <footer class="bg-black">

        <div class="container text-center">

            <p>&copy; StarMovie</p>

        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="frontend/js/pagina principal script.js"></script>
</body>
</html>
