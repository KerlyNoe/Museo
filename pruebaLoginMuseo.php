<?php
session_start();
include_once("Admin.php");

$admin = new Admin();

    //VERIFICAR SI SE HA ENVIADO EL FORMULARIO DE INICIO DE SESIÓN.
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['username']) && isset($_POST['password'])){
            $usuario = $_POST['username'];
            $password = $_POST['password'];

            $usuario = trim(htmlspecialchars($usuario));
            $pass = htmlspecialchars($password);

            $admin->iniciarSesion($usuario, $password);
        }

        if(isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])){
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $admin->obtenerTotal($fechaInicio, $fechaFin);
            header("Location: panelAdministracion.php");
        }

        if(isset($_POST['cerrarSesion'])){
            echo $admin->cerrarSesion();
        }
    }
?>

   