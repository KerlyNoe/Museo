<?php
    class Admin{
        protected $conn;

        function __construct(){
            $dsn = 'mysql:host=localhost;dbname=museo';
            $user = 'root';
            $pass = '';

            try{
                $this->conn = new PDO($dsn,$user,$pass);
            }catch(PDOException $e){
                echo "Error en la conexion " . $e->getMessage();
            }
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
            if(count($resultado) > 0){
                foreach($resultado as $login){
                    $_SESSION['id'] = $login['id'];
                    $_SESSION['username'] = $login['username'];
                    $_SESSION['fullName'] = $login['fullName'];

                    $dia = date("Y-m-d");
                    setcookie("conexion", $dia);
                }
                header("Location: panelAdministracion.php");
            }else{
                //Si el usuario está mal vuelve a cargar la página de login
                header("Location: login.php");
            }
        }

        public function obtenerTotal($fechaInicio, $fechaFin = null){
            if(empty($fechaInicio)){
                echo "La fecha de inicio es obligatoria";
            }

            $ayer = date("Y-m-d", strtotime('-1 day'));
            if($fechaFin == null){
                $fechaFin = $ayer;
            }
             
            $query = "SELECT sum(precio) as total FROM tickets
                      WHERE fecha_visita >= :fechaInicio
                      AND fecha_visita <= :fechaFin";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":fechaInicio", $fechaInicio);
            $stmt->bindParam(":fechaFin", $fechaFin);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['total'] = $resultado['total'];            
        }

        public function cerrarSesion(){
            unset($_SESSION['username']);
            header("Location: login.php");
        }
    }
?>
