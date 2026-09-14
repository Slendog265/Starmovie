<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respuesta_guardada = $_COOKIE['Respuesta'] ?? '';
    $respuesta_enviada = trim($_POST['respuesta'] ?? '');

    if ($respuesta_guardada !== '' && hash_equals((string) $respuesta_guardada, $respuesta_enviada)) {
        $contrasena = $_COOKIE["Contrasena"];
        $correo = $_COOKIE["Correo"];
        
        require("PHPMailer-6.8.1/src/PHPMailer.php");
        require("PHPMailer-6.8.1/src/SMTP.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->isHTML(true);
        
        $mail->Username = getenv('STARMOVIE_SMTP_USERNAME') ?: '';
        $mail->Password = getenv('STARMOVIE_SMTP_PASSWORD') ?: '';

        $mail->SetFrom("starmovieweb@gmail.com");
        $mail->Subject = "Contraseña Recuperada";
        
        // Cuerpo del correo más elaborado
        $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f5f5f5;
                        color: #333;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h1 {
                        color: #007bff;
                    }
                    p {
                        font-size: 16px;
                        line-height: 1.5;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>¡Contraseña Recuperada!</h1>
                    <p>Estimado Usuario,</p>
                    <p>Su codigo ha sido recuperado exitosamente. A continuación, encontrará los detalles:</p>
                    <p><strong>Clave:</strong> ". $_COOKIE['Codigo'] ." </p>
                    <p>Gracias por utilizar nuestros servicios.</p>
                    <p>Atentamente,<br>El equipo de StarMovie</p>
                </div>
            </body>
            </html>
        ";

        $mail->CharSet = 'UTF-8';  // Establecer la codificación de caracteres a UTF-8
        $mail->AddAddress($correo);

        // Verificar si el correo se envió correctamente
        if ($mail->Send()) {
            header("Location: ../../codigo.html");
        } else {
            header("Location: ../../recuperar contrasena.html");
        }
    } else {
        header("Location: ../../respuesta.php?error=1");
    }
    exit;
}

header("Location: ../../respuesta.php?error=1");
?>

