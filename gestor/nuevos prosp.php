<?php
session_start();

// Desactivar el caché para evitar volver a páginas anteriores sin iniciar sesión
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
include 'conexionNP.php';  // Incluir la conexión a la base de datos

// Obtener todos los prospectos del mes actual
$sql = "SELECT * FROM nuevo_prospecto";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>nuevos prospectos</title>
    <link rel="stylesheet" type="text/css" href="css/nuevos prosp.css">
</head>
<body>

<div id="header">
    <a><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>

    <ul id="navigation">
        <li class="current">
            <a href="nuevos prosp.php" class="link2">Registrar Nuevo Prospecto</a>
        </li>
        <li>
            <a href="ventas mensuales.php" class="link1">Ventas Mensuales</a>
        </li>
        <li>
            <a href="prospectos mensuales.php" class="link2">Prospectos Mensuales</a>
        </li>
        <li>
            <a href="contacto.php" class="link1">Contactos</a>
        </li>
        <li>
            <a href="logout.php" class="link2">Cerrar Sesión</a>
        </li>
    </ul>
</div>

<div id="body">
    <div>
        <form action="conexionNP.php" method="POST">
            <h3>REGISTRO DE NUEVO PROSPECTO</h3>
            <label for="NOMBRE">NOMBRE:
                <input type="text" id="nombre" name="nombre" required>
            </label><br>

            <label for="EMPRESA">EMPRESA:
                <input type="text" id="empresa" name="empresa" required>
            </label><br>

            <label for="PRODUCTO">PRODUCTO:
                <input type="text" id="producto" name="producto" required>
            </label><br>

            <label for="CARACTERISTICAS ESPECIFICAS">CARACTERISTICAS ESPECIFICAS:
                <input type="text" id="caracteristicas" name="caracteristicas" required>
            </label><br>

            <label for="PROVEEDOR">PROVEEDOR (MAZIONE, HM):
                <input type="text" id="proveedor" name="proveedor" required>
            </label><br>

            <label for="VENDEDOR">VENDEDOR ENCARGADO:
                <input type="text" id="vendedor" name="vendedor">
            </label><br>

            <label for="CORREO">CORREO ELECTRONICO:
                <input type="text" id="correo" name="correo">
            </label><br>

            <label for="NUMERO">NUMERO DE CONTACTO:
                <input type="text" id="numero" name="numero" required>
            </label><br>

            <label for="DIRECCION">DIRECCION FISICA:</label>
            <textarea id="direciion" name="direccion" class="auto-adjust" oninput="autoResize(this)" required></textarea><br>

            <label for="CONSTANCIA">RFC:
                <input type="text" id="constancia" name="constancia">
            </label><br>

            <label for="estatus">ESTATUS:</label>
        <select name="estatus" id="estatus" required>
            <option value="">--Seleccione--</option>
            <option value="Por contactar">Por contactar</option>
            <option value="contactado">contactado</option>
            <option value="sin contestar">sin contestar</option>
            <option value="Solicitó cotizacion">Solicitó cotizacion</option>
            <option value="Negociando cotizacion">Negociando cotizacion</option>
            <option value="Cliente fidelizado">Cliente fidelizado </option>
            <option value="Descartado">Descartado</option>
        </select>

            <input type="submit" value="Registrar Nuevo Prospecto">
        </form>
    </div>
</div>

<div id="footer"> 
    <div>
    <div id="connect">
            <h3>Social</h3>
            <a href="https://www.facebook.com/GrupoAlmatodo?mibextid=ZbWKwL " target="_blank">
                <img src="images/facebook.png" width="100" alt="Facebook">
            </a>
            <a href="https://www.instagram.com/grupoalmatodo_mex?igsh=MTJuMHl0YTAxa3czNQ== " target="_blank">
                <img src="images/instagram.png" width="100" alt="Instagram">
            </a>
            <a href="https://www.tiktok.com/@grupoalmatodo?_t=8qvcwgLRpdF&_r=1 " target="_blank">
                <img src="images/logotik.png" width="60" alt="Tik Tok">
            </a>
            <a href="https://www.handwaremarket.com/" target="_blank">
                <img src="images/Hardware.png" width="65" alt="Handware Market"></a>
            </a>
            <a href="https://grupoalmatodo.com/" target="_blank">
                <img src="images/GrupoAlma.png" width="65" alt="Handware Market"></a>
            </a>
        </div>
        </div>
        <p>
            &copy; GRUPO ALMATODO S.A.S. DE C.V.
        </p>
</div>

</body>
</html>

    <!-- Cierra el elemento raíz del documento HTML -->
