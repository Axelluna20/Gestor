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

include 'conexionVM.php';  // Incluir la conexión a la base de datos

// Obtener solo los prospectos con estatus "Cliente fidelizado"
$sql = "SELECT ID_Prospecto, nombre, empresa, producto, estatus FROM nuevo_prospecto WHERE estatus = 'Cliente Finalizado'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas Mensuales</title>
    <link rel="stylesheet" type="text/css" href="css/ventas mensuales.css">
</head>
<body>
    <div id="header">
        <a><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>
    </div>

    <div id="body">
        <div>
            <ul id="navigation">
                <li>
                    <a href="Separador.php" class="link1">Inicio</a>
                </li>
                <li>
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

        <div id="content">
            <h1>Historial De Venta</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Producto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ID_Prospecto"] . "</td>";
                            echo "<td>" . $row["nombre"] . "</td>";
                            echo "<td>" . $row["empresa"] . "</td>";
                            echo "<td>" . $row["producto"] . "</td>";
                            echo "<td>" . $row["estatus"] . "</td>"; // Se agrega la columna de Status de nuevo
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay prospectos disponibles con estatus 'Cliente fidelizado'.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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
            <img src="images/GrupoAlma.png" width="65" alt="Grupo Alma">
        </a>
    </div>
    <p>&copy; GRUPO ALMATODO S.A.S. DE C.V.</p>
</body>
</html>

<?php
$conn->close();  // Cerrar la conexión a la base de datos al final
?>
