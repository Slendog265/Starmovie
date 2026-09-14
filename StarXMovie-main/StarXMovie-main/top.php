<?php
    include("backend/php/dol/person.php");
    $prueba = new Person();

    $Movies = $prueba->getPopularMovie();
  
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
                </ul>
            </div>

        </div>

    </nav>
<?php
// Iterate through each movie ID
$it = 0;
$i=0;
$j=0;
foreach ($Movies as $movieId) {
    // Fetch movie details from TMDb API
    $api_key = '4ea50b45d21ada72083adff687e91dce';
    $api_url = "https://api.themoviedb.org/3/movie/{$movieId["IdPelicula"]}?api_key={$api_key}&language=en-US";
    $movie_data = json_decode(file_get_contents($api_url));

    // Output movie details in the specified format
    if ($it % 4 == 0 || $it == 0) {
        echo '<div class="mt-4"></div>';
        echo '<div class="row">';
    }

    echo '<div class="col-md-3">';
    echo '<div class="movie-card" onclick="window.location.href=\'detalle pelicula.php?id=' . $movieId["IdPelicula"] . '\'">';
    echo '<img src="https://image.tmdb.org/t/p/w500' . $movie_data->poster_path . '" class="img-fluid" alt="' . $movie_data->original_title . '">';
    echo '<h2>' . $movie_data->original_title . '</h2>';
    // echo '<p>Director: ' . $movie_data->director . '</p>';
    echo '<p>Puntuación: <span class="puntuacion">' . $movieId["PromedioPuntuacion"] . '</span></p>';
    echo '</div>';
    echo '</div>';

    if (($it + 1) % 4 == 0) {
        echo '</div>';
    }

    $it = $it + 1;
    $i++;
    $j++;
    if($j==5)break;

}

// Close the row div if the number of movies is not a multiple of 4
if ($it % 4 != 0) {
    echo '</div>';
}
?>
<footer class="bg-black">

<div class="container text-center">

    <p>&copy; StarMovie</p>

</div>

</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>