<?php
    session_start();
    include("dol/person.php");

    $prueba=new Person();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["correo"]) && 
            isset($_POST["contrasena"]) && 
            isset($_POST["primer_nombre"]) && 
            isset($_POST["segundo_nombre"]) && 
            isset($_POST["primer_apellido"]) && 
            isset($_POST["segundo_apellido"]) && 
            isset($_POST["fecha_nacimiento"]) && 
            isset($_POST["pregunta_secreta"]) && 
            isset($_POST["respuesta_secreta"]) && 
            isset($_POST["nombre_usuario"]) &&
            strlen($_POST["contrasena"]) >= 3
        ) {
        $prueba->setMail($_POST["correo"]);
        $prueba->setPass($_POST["contrasena"]);
        $prueba->setPNombre($_POST["primer_nombre"]);
        $prueba->setSNombre($_POST["segundo_nombre"]);
        $prueba->setPApellido($_POST["primer_apellido"]);
        $prueba->setSApellido($_POST["segundo_apellido"]);
        $prueba->setFNacimiento($_POST["fecha_nacimiento"]);
        $prueba->setIdPregunta($_POST["pregunta_secreta"]);
        $prueba->setRespuesta($_POST["respuesta_secreta"]);
        $prueba->setNUsuario($_POST["nombre_usuario"]);

        if($prueba->personExist($prueba->getNUsuario()))echo "Usuario existente";
        else $prueba->addUser($prueba);
        $prueba = $prueba->getUser($prueba);
        $_SESSION['usuario_activo'] = json_encode($prueba);
            header("Location: ../../categoria.php");
        }else {
            // Manejar el caso en el que algún campo está vacío o la contraseña no cumple con los requisitos
            echo "Por favor, complete todos los campos y asegúrese de que la contraseña tenga al menos 3 caracteres.";
        }
    }
?>