<?php
    class Admin{
        private $conn;

        function __construct($conn){
            $this->conn = $conn;
        }

        
        public function iniciarSesion($usuario, $password){
            $query = "SELECT id,username, fullName  FROM admin 
                    WHERE  LOWER(username) =LOWER(:usuario) 
                    AND password = md5(:password)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($resultado->num_rows > 0){
                foreach($resultado as $login){
                    $_SESSION['username'] = $login['username'];
                }
                echo '<h2>Ingrese fechas de inicio y fin</h2>';
                echo '<form action="pruebaLoginMuseo.php" method="post">';
                    echo '<label for="fechaInicio">Fecha de inicio:</label>';
                    echo '<input type="date" name="fechaInicio" id="fechaInicio">';
                    echo '<label for="fechaFin">Fecha de fin:</label>';
                    echo '<input type="date" name="fechaFin" id="fechaFin">';
                    echo '<input type="submit" value="Obtener Total">';
                echo '</form>';   
            }else{
                echo "Usuario o contraseña incorrecta";
            }
        }
    }
?>
