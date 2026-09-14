<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recuperar Contraseña</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <link href="frontend/css/recuperar contrasena style.css" rel="stylesheet">

</head>

<body>

    <header>

        <div class="container text-center">

            <h1>Recuperar Contraseña</h1>

        </div>

    </header>
    
    <main class="py-5">
        <div class="container">
            <section class="bg-white p-4 rounded shadow-lg" style="max-width: 380px; margin: 0 auto;">
                <h2 class="text-center">¿Olvidaste tu contraseña?</h2>
                <p class="text-center">Responde la pregunta</p>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        Respuesta incorrecta. Inténtelo de nuevo.
                    </div>
                <?php endif; ?>

                <form action="backend/php/respuesta.php" method="post">
                <p class="text-center"><?php echo $_COOKIE['Pregunta']; ?></p>
                    <div class="mb-3">
                        <input type="text" name="respuesta" id="respuesta" class="form-control"
                            placeholder="Responda" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Enviar enlace de recuperación" class="btn btn-primary btn-block">
                    </div>
                </form>
                
                <p class="mt-3 text-center">¿Recuerdas tu contraseña? <a href="login.html">Inicia sesión aquí</a></p>
            </section>
        </div>
    </main>
    
    <footer>

        <div class="container text-center">

            <p>&copy; StarMovie</p>

        </div>

    </footer>
    
</body>

</html>