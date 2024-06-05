<?php
include_once("ConexionDB.php");
    class VentaTickets{
        private $conn;

        function __construct($conn){
            $this->conn = $conn;
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
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $total){
                echo "<h2>El total de la venta es: " . $total['total'] . "</h2>";
            }
            echo '<a href="pruebaMuseo.php?cerrar_sesion=true">Cerrar Sesión</a>';

        }
    }

?>