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

include 'conexionHisCot.php';  // Incluir la conexión a la base de datos

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener solo las cotizaciones con estatus "finalizado"
$sql = "SELECT * FROM cotizaciones WHERE estatus = 'Cliente Finalizado'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Almacenar las cotizaciones en un array
$cotizaciones = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cotizaciones[] = $row; // Almacena cada fila en el array
    }
}

// Código HTML
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Historial de Cotizaciones</title>
    <link rel="stylesheet" type="text/css" href="css/prosp mensual.css">
</head>
<body>
    <header id="header">
        <a><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>
    </header>

    <nav>
        <ul id="navigation">
            <li><a href="Separador.php" class="link1">Inicio</a></li>
            <li><a href="contacto.php" class="link1">Cotizaciones(Compras)</a></li>
            <li><a href="historial_cotizaciones.php" class="link1">Cotizaciones</a></li>
            <li><a href="historialCot.php" class="link1">Historial De Cotizaciones</a></li>
            <li><a href="logout.php" class="link2">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main id="content">
        <h1>Historial de Cotizaciones</h1>
        <table>
            <thead>
                <tr>
                    <th>ID_Cotización</th>
                    <th>Vendedor</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Entrega</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Comprobar si hay cotizaciones almacenadas
                if (!empty($cotizaciones)) {
                    foreach ($cotizaciones as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row["vendedor"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["fecha_inicio"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["fecha_entrega"]) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row["cliente"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["producto"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["estatus"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay cotizaciones finalizadas en el historial.</td></tr>"; // Ajustar el número de columnas
                }
                ?>
            </tbody>
        </table>
    </main>

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
<footer>
    <p>&copy; GRUPO ALMATODO</p>
</footer>
</body>
</html>
