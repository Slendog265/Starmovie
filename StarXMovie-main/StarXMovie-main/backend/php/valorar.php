<?php
include("dol/person.php");

session_start();
$datos=json_decode($_SESSION["usuario_activo"],true);

$prueba = new Person();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar la puntuación y el ID de la película desde el formulario
    $puntuacion = $_POST["rating"];
    $pelicula_id = $_POST["pelicula_id"];
    $comentario = $_POST["comentary"];
    $NUsuario=$datos["NUsuario"];
    // Mostrar la información (puedes realizar otras operaciones aquí)
    //echo "ID de la Película: " . htmlspecialchars($pelicula_id) . "<br>";
    //echo "Puntuación: " . htmlspecialchars($puntuacion);
    if ($prueba->rateExists($pelicula_id,$NUsuario) == true) {
        //$prueba->addRate($comentario,$pelicula_id,$puntuacion,$datos["NUsuario"]);
        //echo "Existe Rate";
        header("Location: ../../pagina%20principal.php");
    } else {
        $prueba->addRate($comentario,$pelicula_id,$puntuacion,$datos["NUsuario"]);
        header("Location: ../../pagina%20principal.php");
    }

}
?>
