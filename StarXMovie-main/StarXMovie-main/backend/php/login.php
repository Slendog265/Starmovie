<?php
session_start();
include("dol/person.php");

$prueba = new Person();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prueba->setNUsuario($_POST["nombre_usuario"] ?? '');
    $prueba->setPass($_POST["contrasena"] ?? '');

    $query = "SELECT Contrasena FROM usuario WHERE NUsuario = :nombre_usuario";
    $strxt=$prueba->getNUsuario();
    try {
        $statement = $prueba->connection->prepare($query);
        $statement->bindParam(':nombre_usuario', $strxt, PDO::PARAM_STR);
        $statement->execute();

        // Verifica si hay resultados
        $registro = $statement->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            // Verifica la contraseña
            if (password_verify($_POST["contrasena"], $registro['Contrasena'])) {
                $prueba = $prueba->getUser($prueba);
                $_SESSION['usuario_activo'] = json_encode($prueba);

                // Redirige a la página principal
                if ($prueba->getCFavorita() != null) {
                    header("Location: ../../pagina%20principal.php");
                } else {
                    header("Location: ../../categoria.php");
                }
                exit;
            } else {
                header("Location: ../../login.html?error=1");
            }
        } else {
            header("Location: ../../login.html?error=1");
        }
    } catch (Exception $e) {
        header("Location: ../../login.html?error=1");
    }
    exit;
}
?>

