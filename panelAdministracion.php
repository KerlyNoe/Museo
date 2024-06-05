<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administrador</title>
    </head>
    <body>
        <h1>Bienvenid@ <?= $_SESSION['fullName']; ?></h1>
        <p>última conexión: <?= $_COOKIE["conexion"]; ?></p>
        <h2>Selleciona fecha de Iinicio y fecha de Fin </h2>
        <form action="pruebaLoginMuseo.php" method="post">
            <label for="fechaInicio">Fecha de inicio:</label>
            <input type="date" name="fechaInicio" id="fechaInicio">
            <label for="fechaFin">Fecha de fin:</label>
            <input type="date" name="fechaFin" id="fechaFin">
            <input type="submit" value="Calcular total">
        </form>
        <h2>Total de ventas: <?= $_SESSION['total']; ?><h2>
        <form action="pruebaLoginMuseo.php" method="post">
            <br>
            <input type="submit" name="cerrarSesion" value="Cerrar sesión">
        </form>

        </div>
    </body>
</html>
