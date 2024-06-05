<?php
    class ConexionDB{
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

        public function getConexion(){
            return $this->conn;
        }
    }

?>


