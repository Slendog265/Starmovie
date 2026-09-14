<?php
include('dol/person.php');
session_start();

// Verifica si la sesión 'usuario_activo' está establecida y no está vacía
if (isset($_SESSION["usuario_activo"]) && !empty($_SESSION["usuario_activo"])) {
    $datos = json_decode($_SESSION["usuario_activo"], true);

    // Verifica si la variable 'categoria' está presente en la URL
    if (isset($_GET['categoria'])) {
        $categoria_seleccionada = $_GET['categoria'];
        $nombre_usuario = $datos['NUsuario'];

        $prueba = new Person();

        // Asegúrate de que 'addFavoriteCategory' y 'setNUsuario' sean métodos válidos en tu clase Person
        $prueba->addFavoriteCategory($nombre_usuario, $categoria_seleccionada);
        $prueba->setNUsuario($nombre_usuario);

        // Recupera los datos actualizados del usuario
        $prueba = $prueba->getUser($prueba);

        // Actualiza la sesión del usuario activo
        $_SESSION['usuario_activo'] = json_encode($prueba);

        // Redirige a la página principal después de procesar la categoría
        header("Location: ../../pagina%20principal.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        // Si no se ha seleccionado ninguna categoría, puedes manejarlo aquí
        // Puedes dejar el código en este bloque o redirigir a otra página
        // header('Location: otra_pagina.php');
    }
} else {
    // Manejo de sesión no válida, redirige a la página de inicio de sesión u otra página de inicio
    header('Location: ../../login.html');
    exit();
}
?>



