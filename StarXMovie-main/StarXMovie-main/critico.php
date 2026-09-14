<?php
// Obtén el valor del parámetro "usuario" desde la URL
$usuario = $_GET['usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="frontend/css/pefil style.css" rel="stylesheet">
</head>
<body>
    
<?php
session_start();
$datos=json_decode($_SESSION["usuario_activo"],true);
include("backend/php/dol/person.php");
$prueba = new Person();
$movies = $prueba->getUserRateMovie($usuario);

$consulta = "SELECT Mail, PNombre, SNombre, PApellido, SApellido, CFavorita, FPerfil FROM usuario WHERE NUsuario = :NUsuario";
    
        $stmt = $prueba->connection->prepare($consulta);
        $stmt->bindParam(':NUsuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
?>


    <div class="modal">
        <img src="" alt="Imagen Ampliada">
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="pagina principal.php">
                <img class="rounded-image" src="frontend/image/Logo.jpg" alt="NexoWeb">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pagina principal.php">Pagina principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="acerca de.html">Acerca de</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img src="frontend/image/perfil/<?php echo $results[0]['FPerfil']; ?>";

                                     alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; z-index: 1">
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5><?php echo $usuario;?></h5>
                                <p><?php echo $results[0]['PNombre']." ".$results[0]['SNombre']." ".$results[0]['PApellido']." ".$results[0]['SApellido'];?></p>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5"><?php echo count($movies)?></p>
                                    <p class="small text-muted mb-0">Calificaciones</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1">Acerca de</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1"><?php echo $results[0]['Mail'];?></p>
                                    <p class="font-italic mb-1">Mis peliculas favoritas son <?php echo $results[0]['CFavorita'];?></p>
                                    <!--<p class="font-italic mb-0">Esta es su profesion</p>-->
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0">Peliculas calificadas</p>
                                <p class="mb-0"><a href="#!" class="text-muted">Ver todas</a></p>
                            </div>
                            <?php
                                $i = 0;
                                // Inicio del contenedor de filas
                                echo '<div class="row g-2">';

                                foreach ($movies as $row) {
                                    // Fetch movie details from TMDb API
                                    $api_key = '4ea50b45d21ada72083adff687e91dce';
                                    $api_url = "https://api.themoviedb.org/3/movie/{$row['IdPelicula']}?api_key={$api_key}&language=en-US";
                                    $movie_data = json_decode(file_get_contents($api_url));

                                    // Inicio de la columna
                                    echo '<div class="col mb-2 col-md-6">';
                                    echo '<div class="movie-card" onclick="window.location.href=\'detalle pelicula.php?id=' . $row['IdPelicula'] . '\'">';
                                    echo '<img src="https://image.tmdb.org/t/p/w500' . $movie_data->poster_path . '" class="img-fluid" alt="' . $movie_data->original_title . '">';
                                    echo '<h2>' . $movie_data->original_title . '</h2>';
                                    // Si el API proporciona información sobre el director, puedes usarlo aquí
                                    // echo '<p>Director: ' . $movie_data->director . '</p>';
                                    echo '<p>Puntuación: <span class="puntuacion">' . $row['Puntuacion'] . '</span></p>';
                                    echo '</div>';
                                    echo '</div>';

                                    // Fin de la columna
                                    $i++;

                                    // Si $i es divisible por 2, cierra la fila actual e inicia una nueva
                                    if ($i % 2 == 0) {
                                        echo '</div>'; // Fin de la fila actual
                                        echo '<div class="row g-2">'; // Inicio de una nueva fila
                                    }
                                }

                                // Fin del contenedor de filas
                                echo '</div>';
                            ?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-black">

        <div class="container text-center">

            <p>&copy; StarMovie</p>

        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="frontend/js/perfil script.js"></script>
   

</body>
</html>
