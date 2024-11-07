<?php
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contactos</title>
    <link rel="stylesheet" type="text/css" href="css/proveedor.css">
</head>
<body>
    <div id="header">
        <a href="#"><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>
    </div>

    <!-- Menú de navegación -->
    <ul id="navigation">
        <li><a href="Separador.php" class="link1">Inicio</a></li>
        <li><a href="reg_proveedor.php" class="link1">Registro De Proveedores</a></li>
        <li><a href="proveedores.php" class="link1">Proveedores</a></li>
        <li><a href="historial_proveedor.php" class="link1">Historial De Proveedores</a></li>
        <li><a href="logout.php" class="link2">Cerrar Sesión</a></li>
    </ul>

    <div id="body">
        <div id="contact">
        <form action="conexionPro.php" method="POST">
    <input type="hidden" name="agregar" value="1">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="constancia_fiscal">Constancia Fiscal:</label>
    <input type="text" name="constancia_fiscal" required><br>

    <label for="razon">Razón:</label>
    <input type="text" name="razon" required><br>

    <label for="regimen">Régimen:</label>
    <input type="text" name="regimen" required><br>

    <label for="rfc">RFC:</label>
    <input type="text" name="rfc" required><br>

    <label for="domicilio_fiscal">Domicilio Fiscal:</label>
    <input type="text" name="domicilio_fiscal" required><br>

    <label for="domicilio_operativo">Domicilio Operativo:</label>
    <input type="text" name="domicilio_operativo" required><br>

    <label for="contacto">Contacto:</label>
    <input type="text" name="contacto" required><br>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" required><br>

    <label for="lista">Lista:</label>
    <input type="text" name="lista" required><br>

    <label for="producto">Producto:</label>
    <input type="text" name="producto" required><br>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" required><br>

    <label for="anotaciones">Anotaciones:</label>
    <textarea name="anotaciones"></textarea><br>
                <button type="submit" style="background-color: #02164d; color: white; padding: 10px 20px; border: none; cursor: pointer;">GUARDAR PROVEEDOR</button>
            </form>
        </div>
    </div>

    <div id="connect">
        <h3>Social</h3>
        <a href="https://www.facebook.com/GrupoAlmatodo?mibextid=ZbWKwL" target="_blank">
            <img src="images/facebook.png" width="100" alt="Facebook">
        </a>
        <a href="https://www.instagram.com/grupoalmatodo_mex?igsh=MTJuMHl0YTAxa3czNQ==" target="_blank">
            <img src="images/instagram.png" width="100" alt="Instagram">
        </a>
        <a href="https://www.tiktok.com/@grupoalmatodo?_t=8qvcwgLRpdF&_r=1" target="_blank">
            <img src="images/logotik.png" width="60" alt="Tik Tok">
        </a>
        <a href="https://www.handwaremarket.com/" target="_blank">
            <img src="images/Hardware.png" width="65" alt="Handware Market">
        </a>
        <a href="https://grupoalmatodo.com/" target="_blank">
            <img src="images/GrupoAlma.png" width="65" alt="Grupo Almatodo">
        </a>
    </div>

    <p>&copy; GRUPO ALMATODO S.A.S. DE C.V.</p>
</body>
</html>
