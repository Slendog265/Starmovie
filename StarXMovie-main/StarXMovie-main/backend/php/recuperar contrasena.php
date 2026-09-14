<?php
    // Incluye el archivo de conexión a la base de datos
    include("dol/person.php");
    $prueba = new Person();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["correo"];
        $nombre_usuario = $_POST["nombre_usuario"];

        // Consulta la pregunta y respuesta de seguridad del usuario
        $query = "SELECT pregunta.Interrogante, usuario.Respuesta, usuario.Contrasena FROM usuario
        INNER JOIN pregunta ON usuario.IdPregunta = pregunta.IdPregunta
        WHERE usuario.Mail = :correo AND usuario.NUsuario = :nombre_usuario";
          
        $statement = $prueba->connection->prepare($query);
        $statement->bindParam(':correo', $correo, PDO::PARAM_STR);
        $statement->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        $statement->execute();

        $registro = $statement->fetch(PDO::FETCH_ASSOC);

        if ($registro) {
            $pregunta = $registro['Interrogante'];
            $respuesta = $registro['Respuesta'];
            //$contrasena = $registro['Contrasena'];
            setcookie("NUsuario", $nombre_usuario, time() + 600, "/");
            setcookie("Contrasena", $contrasena, time() + 600, "/");
            setcookie("Respuesta", $respuesta, time() + 600, "/");
            setcookie("Correo", $correo, time()+600, "/");
            setcookie("Pregunta", $pregunta, time()+600, "/");
            setcookie("Codigo",uniqid(), time()+600, "/");
            header("Location: ../../respuesta.php");
            // echo $pregunta." ".$respuesta." ".$contrasena;
        }else{
            header("Location: ../../recuperar contrasena.html");
        }
    }
?>