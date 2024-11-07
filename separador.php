<?php
session_start();

// Desactivar el caché para evitar volver a páginas anteriores sin iniciar sesión
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Elige Tu Área</title>
    <link rel="stylesheet" type="text/css" href="css/separador.css">
    <div id="header">
    <b><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></b>

</head>
<body>


<div class="options-container">
    <h1>Modulos</h1>

    <div class="option">
        <a href="nuevos prosp.php">Prospectos(Marketing)</a>
    </div>
    <div class="option">
        <a href="contacto.php">Seguimiento de cotizaciones(Productos Nuevos)</a>
    </div>
    <div class="option">
        <a href="reg_proveedor.php">Seguimiento de ventas</a>
    </div>
    <div class="option">
        <a href="logout.php">Cerrar Sesión</a>
    </div>
</div>

</body>
</html>
