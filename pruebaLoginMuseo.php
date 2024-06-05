<?php
session_start();
include_once("ConexionDB.php");
include_once("Admin.php");
include_once("VentaTickets.php");
include_once("CerrarSesion.php");

$conexion = new ConexionDB();

    //VERIFICAR SI SE HA ENVIADO EL FORMULARIO DE INICIO DE SESIÓN.
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $admin = new Admin($conexion->getConexion());
        $usuario = $_POST['username'];
        $password = $_POST['password'];

        $usuario = trim(htmlspecialchars($usuario));
        $pass = htmlspecialchars($password);

        $admin->iniciarSesion($usuario, $password);

        //VERIFICAR SI SE HA ENVIADO EL FORMULARIO DE FECHA DE INICIO Y FIN.
        $venta = new VentaTickets($conexion);
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];

        $venta->obtenerTotal($fechaInicio, $fechaFin);

        //VERIFICAR SI SE HA ENVIADO EL FORMULARIO PARA CERRAR SESIÓN.
        $close = new CerrarSesion();
        $close->cerrarSesion();
    }
?>

   