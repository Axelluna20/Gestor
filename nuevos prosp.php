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

include 'conexionNP.php'; // Incluir la conexión a la base de datos

// Inicializar variables
$nombre = $empresa = $producto = $caracteristicas = $correo = $vendedor = $numero = $direccion = $constancia = $estatus = '';

// Obtener todos los prospectos del mes actual
$sql = "SELECT * FROM nuevo_prospecto";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Nuevos Prospectos</title>
    <link rel="stylesheet" type="text/css" href="css/nuevos prosp.css">
</head>
<body>

<div id="header">
    <a><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>

    <ul id="navigation">
        <li>
            <a href="Separador.php" class="link1">Inicio</a>
        </li>
        <li class="current">
            <a href="nuevos prosp.php" class="link2">Registrar Nuevo Prospecto</a>
        </li>
        <li>
            <a href="prospectos mensuales.php" class="link2">Prospectos Mensuales</a>
        </li>
        <li>
            <a href="ventas mensuales.php" class="link1">Ventas Mensuales</a>
        </li>
        <li>
            <a href="logout.php" class="link2">Cerrar Sesión</a>
        </li>
    </ul>
</div>

<div id="body">
    <div>
        <form method="POST" action="conexionNP.php">
            <h3>REGISTRO DE NUEVO PROSPECTO</h3>

            <label for="nombre" style="color: #02164d;">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            <br>
            
            <label for="empresa" style="color: #02164d;">Empresa:</label>
            <input type="text" name="empresa" value="<?php echo htmlspecialchars($empresa); ?>" required>
            <br>
            
            <label for="producto" style="color: #02164d;">Producto:</label>
            <input type="text" name="producto" value="<?php echo htmlspecialchars($producto); ?>" required>
            <br>
            
            <label for="caracteristicas" style="color: #02164d;">Características y/o descripción de descartado:</label>
            <input type="text" name="caracteristicas" value="<?php echo htmlspecialchars($caracteristicas); ?>" required>
            <br>
            
            <label for="correo" style="color: #02164d;">Correo:</label>
            <input type="email" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required>
            <br>
            
            <label for="vendedor" style="color: #02164d;">Vendedor:</label>
            <input type="text" name="vendedor" value="<?php echo htmlspecialchars($vendedor); ?>" required>
            <br>
            
            <label for="numero" style="color: #02164d;">Número:</label>
            <input type="text" name="numero" value="<?php echo htmlspecialchars($numero); ?>" required>
            <br>
            
            <label for="direccion" style="color: #02164d;">Dirección:</label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required>
            <br>
            
            <label for="constancia" style="color: #02164d;">Constancia:</label>
            <input type="text" name="constancia" value="<?php echo htmlspecialchars($constancia); ?>" required>
            <br>

            <label for="estatus">ESTATUS:</label>
            <select name="estatus" id="estatus" required>
                <option value="">--Seleccione--</option>
                <option value="Por contactar" <?php if ($estatus == "Por contactar") echo "selected"; ?>>Por contactar</option>
                <option value="contactado" <?php if ($estatus == "contactado") echo "selected"; ?>>Contactado</option>
                <option value="sin contestar" <?php if ($estatus == "sin contestar") echo "selected"; ?>>Sin Contestar</option>
                <option value="Solicitó cotizacion" <?php if ($estatus == "Solicitó cotizacion") echo "selected"; ?>>Solicitó Cotización</option>
                <option value="Negociando cotizacion" <?php if ($estatus == "Negociando cotizacion") echo "selected"; ?>>Negociando Cotización</option>
                <option value="Cliente fidelizado" <?php if ($estatus == "Cliente fidelizado") echo "selected"; ?>>Cliente Fidelizado</option>
                <option value="Descartado" <?php if ($estatus == "Descartado") echo "selected"; ?>>Descartado</option>
            </select>
            <br>

            <input type="submit" value="Registrar Nuevo Prospecto">
        </form>
    </div>
</div>

<div id="footer"> 
    <div>
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
    </div>
    <p>
        &copy; GRUPO ALMATODO S.A.S. DE C.V.
    </p>
</div>

</body>
</html>
