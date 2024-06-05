<?php

    class CerrarSesion{

        public function cerrarSesion(){
            unset($_SESSION['username']);
            echo "Se ha cerrado la sección";
        }
    }

?>