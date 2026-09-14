<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cards - Tarjetas con efecto Hover</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/categoria.css">
    <style>
        .selected {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Tarjetas -->
    <div class="container mt-5">
        <div class="title-cards text-center">
            <h2></h2>
        </div>
        <div class="row">
            <?php
            $connection;
            $categoria_favorita;
            try {
                $connection = new PDO('mysql:host=localhost;dbname=starxmovie', 'root', '');
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->exec("SET CHARACTER SET UTF8");

                $consulta = "SELECT NCategoria FROM categoria_pelicula";
                $stmt = $connection->prepare($consulta);
                $stmt->execute();

                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    mostrarTarjeta($result['NCategoria']);
                }
            } catch (PDOException $e) {
                die("Error connecting to the database: " . $e->getMessage());
            }

            function mostrarTarjeta($categoria) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="frontend/image/categoria/' . $categoria . '.jpg" class="card-img-top" alt="' . $categoria . '">';
                echo '<div class="card-body">';
                echo '<button class="btn btn-primary category-btn" data-category="' . $categoria . '">' . $categoria . '</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="mt-3 text-center">
            <button class="btn btn-secondary" id="prevBtn">Anterior</button>
            <button class="btn btn-secondary" id="nextBtn">Siguiente</button>
        </div>
        <div></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedCategory = '';

            $('.category-btn').click(function(e) {
                e.preventDefault();
                $('.category-btn').removeClass('selected');
                $(this).addClass('selected');
                selectedCategory = $(this).data('category');
            });

            $('#prevBtn').click(function(e) {
                e.preventDefault();
                window.location.href = 'login.html';
            });

            $('#nextBtn').click(function(e) {
                e.preventDefault();
                let selectedCategory = $('.category-btn.selected').data('category');

                if (selectedCategory != null) {
                    // Aquí puedes usar directamente el valor en JavaScript
                    alert('Categoría seleccionada: ' + selectedCategory);
                    window.location.href = 'backend/php/guardar categoria.php?categoria=' + encodeURIComponent(selectedCategory);
                } else {
                    alert('Por favor, selecciona una categoría antes de continuar.');
                }
            });
        });
    </script>
    <footer class="bg-black">

<div class="container text-center">

    <p>&copy; StarMovie</p>

</div>

</footer>
</body>
</html>

