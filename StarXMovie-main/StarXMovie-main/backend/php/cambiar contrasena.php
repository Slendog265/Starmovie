<?php
    // Incluye el archivo de conexión a la base de datos
    include("dol/person.php");
    $prueba = new Person();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigo = $_POST["respuesta"];
        $contrasena = $_POST["contrasena"];
        $verificar = $_POST["verificar"];
        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

        $nombre_usuario = $_COOKIE["NUsuario"];

        if($codigo==$_COOKIE["Codigo"] && $contrasena==$verificar){
            // Consulta la pregunta y respuesta de seguridad del usuario
        $query = "UPDATE usuario SET contrasena = :contrasena WHERE NUsuario = :nombre_usuario";
          
        $statement = $prueba->connection->prepare($query);
        $statement->bindParam(':contrasena', $contrasena_cifrada, PDO::PARAM_STR);
        $statement->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        $statement->execute();

        header("Location: ../../login.html");
        exit(); // Asegura que el script se detenga después de redirigir
        }else{
            echo "Error";
        }
    }
?>