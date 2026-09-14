<?php

class Admin {
    public $connection;
    public $CantidadPeliculas;
  
    public function __construct() {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=starxmovie', 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("SET CHARACTER SET UTF8");
        } catch (PDOException $e) { // Cambiado Exception a PDOException
            die("Error: " . $e->getMessage());
        }
    }
    public function getQuestion(){
        $consulta = "SELECT * FROM Pregunta";
        // Cambiado mysqli_query a $this->connection->query
        if ($resultado = $this->connection->query($consulta)) {
            while ($registro = $resultado->fetch()) { // Cambiado mysqli_fetch_assoc a fetch
                // Aquí puedes hacer algo con los datos obtenidos
                echo "<option value=".$registro["IdPregunta"].">".$registro['Interrogante']."</option>";
            }
        }
    }
    public function getCommentary($id){
        $consulta = "SELECT votos.NUsuario, votos.Puntuacion, votos.Comentario, votos.Fecha, usuario.FPerfil FROM votos INNER JOIN usuario ON (votos.NUsuario = usuario.NUsuario) WHERE votos.IdPelicula = :id_pelicula ORDER BY votos.Fecha DESC";
    
        $stmt = $this->connection->prepare($consulta);
        $stmt->bindParam(':id_pelicula', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    public function getUserRateMovie($NUsuario) {
        $consulta = "SELECT IdPelicula, Puntuacion FROM votos WHERE NUsuario = :NUsuario";
    
        $stmt = $this->connection->prepare($consulta);
        $stmt->bindParam(':NUsuario', $NUsuario, PDO::PARAM_STR);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;

        foreach ($results as $row) {
            // Imprime el contenido del array
            echo "IdPelicula: " . $row['IdPelicula'] . ", Puntuacion: " . $row['Puntuacion'] . "<br>";
        }
    }
    
    public function getUser($person){
        $consulta="SELECT * FROM usuario WHERE NUsuario = :nombre_usuario";

        try {
            $stmt = $this->connection->prepare($consulta);
            $userData = [
                ':nombre_usuario' => $person->getNUsuario(),
            ];

            // Vincula los valores y ejecuta la consulta
            $stmt->execute($userData);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $person->setNUsuario($person->getNUsuario());
            $person->setPNombre($result["PNombre"]);
            $person->setSNombre($result["SNombre"]);
            $person->setPApellido($result["PApellido"]);
            $person->setSApellido($result["SApellido"]);
            $person->setMail($result["Mail"]);
            $person->setFPerfil($result["FPerfil"]);
            $person->setFNacimiento($result["FNacimiento"]);
            $person->setFPerfil($result["FPerfil"]);
            $person->setPass("/%(--");
            $person->setCFavorita($result["CFavorita"]);
            
            return $person;

        } catch (PDOException $e) {
            // Manejar errores de consulta de manera más adecuada, por ejemplo, registrándolos o lanzando excepciones personalizadas.
            die("Error: " . $e->getMessage());
        }
    }
    public function getAverages() {
        $averagesArray = array();
        $i = 0;
    
        foreach ($this->getMovieIds() as $movieId) {
            $averagesArray[$i] = 0.0;
            $consulta = "SELECT Puntuacion FROM votos WHERE IdPelicula = " . $movieId;
    
            // Consulta SQL para obtener puntuaciones de la película actual
            $stmt = $this->connection->prepare($consulta);
            $stmt->execute();
    
            // FetchAll devuelve un array con todas las filas del resultado
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $j = 0;
    
            foreach ($result as $puntuacion) {
                $averagesArray[$i] += $puntuacion;
                $j++;
            }
    
            // Calcular el promedio solo si hay puntuaciones
            if ($j > 0) {
                $averagesArray[$i] = $averagesArray[$i] / $j;
            }
    
            $i++;
        }
    
        return $averagesArray;
    }
    
    public function getMovieIds() {
        $consulta = "SELECT DISTINCT IdPelicula FROM votos";
    
        // Consulta SQL para obtener IDs de películas sin repeticiones
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute();
    
        // FetchAll devuelve un array con todas las filas del resultado
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        return $result;
    }
    public function getPopularMovie() {
        $consulta = "SELECT IdPelicula, AVG(Puntuacion) AS PromedioPuntuacion FROM votos GROUP BY IdPelicula ORDER BY PromedioPuntuacion DESC";
    
        // Consulta SQL para obtener IDs de películas sin repeticiones
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute();
    
        // FetchAll devuelve un array con todas las filas del resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    public function rateExists($id,$NUsuario) {
        $consulta = "SELECT COUNT(*) FROM votos WHERE IdPelicula = :id_pelicula AND NUsuario = :nombre_usuario";

        // Consulta SQL para verificar si el nombre de usuario ya existe
        $stmt = $this->connection->prepare($consulta);
        $stmt->bindParam(':id_pelicula', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_usuario', $NUsuario, PDO::PARAM_STR);
        $stmt->execute();

        // Obtenemos el resultado de la consulta
        $resultado = $stmt->fetchColumn();

        return $resultado > 0;
    }
    public function addRate($str, $id, $rate, $NUsuario) {
        $fecha_publicacion = date("Y-m-d H:i:s");
    
        // Consulta SQL para insertar una calificación en la tabla de votos
        $consulta = "INSERT INTO votos (IdPelicula, Comentario, Puntuacion, NUsuario, Fecha)
                     VALUES (:id_pelicula, :comentario, :puntuacion, :nombre_usuario, :fecha)";
    
        // Consulta SQL para verificar si el nombre de usuario ya existe
        $stmt = $this->connection->prepare($consulta);
        $stmt->bindParam(':id_pelicula', $id, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $str, PDO::PARAM_STR);
        $stmt->bindParam(':puntuacion', $rate, PDO::PARAM_STR); // Mantenemos PDO::PARAM_STR ya que estamos usando bindParam
        $stmt->bindParam(':nombre_usuario', $NUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha_publicacion, PDO::PARAM_STR); // Mantenemos PDO::PARAM_STR ya que estamos usando bindParam
    
        $stmt->execute();
    }
    public function addFavoriteCategory($NUsuario, $CFavorita) {
        $consulta = "UPDATE usuario 
                    SET CFavorita = :categoria_favorita
                    WHERE NUsuario = :nusuario";
    
        try {
            $stmt = $this->connection->prepare($consulta);
            $userData = [
                ':categoria_favorita' => $CFavorita,
                ':nusuario' => $NUsuario,
            ];
    
            // Vincula los valores y ejecuta la consulta
            $stmt->execute($userData);
    
            // Puedes devolver un mensaje de éxito o hacer algo más después de la actualización
            return "Categoría favorita actualizada con éxito.";
    
        } catch (PDOException $e) {
            // Manejar errores de consulta de manera más adecuada, por ejemplo, registrándolos o lanzando excepciones personalizadas.
            die("Error: " . $e->getMessage());
        }
    }
    
    public function addUser($person) {
        $consulta = "INSERT INTO usuario (PNombre, SNombre, PApellido, SApellido, NUsuario, Mail, Contrasena, IdPregunta, Respuesta, FNacimiento) 
                    VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :nombre_usuario, :correo, :contrasena, 
                    :pregunta_secreta, :respuesta_secreta, :fecha_nacimiento)";
        
        try {
            $stmt = $this->connection->prepare($consulta);
            $userData = [
                ':primer_nombre' => $person->getPNombre(),
                ':segundo_nombre' => $person->getSNombre(),
                ':primer_apellido' => $person->getPApellido(),
                ':segundo_apellido' => $person->getSApellido(),
                ':nombre_usuario' => $person->getNUsuario(),
                ':correo' => $person->getMail(),
                ':contrasena' => $person->getPass(),
                ':pregunta_secreta' => $person->getIdPregunta(),
                ':respuesta_secreta' => $person->getRespuesta(),
                ':fecha_nacimiento' => $person->getFNacimiento(),
            ];
    
            // Vincula los valores y ejecuta la consulta
            $stmt->execute($userData);

        } catch (PDOException $e) {
            // Manejar errores de consulta de manera más adecuada, por ejemplo, registrándolos o lanzando excepciones personalizadas.
            die("Error: " . $e->getMessage());
        }
    }
    

    public function personExist($str){
        $consulta = "SELECT COUNT(*) FROM usuario WHERE NUsuario = :nombre_usuario";

        // Consulta SQL para verificar si el nombre de usuario ya existe
        $stmt = $this->connection->prepare($consulta);
        $stmt->bindParam(':nombre_usuario', $str, PDO::PARAM_STR);
        $stmt->execute();

        // Obtenemos el resultado de la consulta
        $resultado = $stmt->fetchColumn();

        return $resultado > 0;
    }

    public function userExist($person) {
        if ($this->personExist($person->getNUsuario())) {
            $consulta = "SELECT Contrasena FROM usuario WHERE NUsuario = :nombre_usuario";
    
            try {
                $stmt = $this->connection->prepare($consulta);
                $userData = [
                    ':nombre_usuario' => $person->getNUsuario(),
                ];
    
                // Vincula los valores y ejecuta la consulta
                $stmt->execute($userData);
    
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
                return ($person->getPass()==$result['Contrasena']) ? true : false;

            } catch (PDOException $e) {
                // Manejar errores de consulta de manera más adecuada, por ejemplo, registrándolos o lanzando excepciones personalizadas.
                die("Error: " . $e->getMessage());
            }
        }
    
        return false; // Retorna false si el usuario no existe
    }

}
  
?>
