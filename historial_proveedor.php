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

// Incluir la conexión a la base de datos de proveedores
include 'conexionPro.php'; // Cambiado a conexionPro.php

// Obtener todos los proveedores cuyo producto sea 'Playo'
$sql = "SELECT * FROM proveedores WHERE producto = 'Playo'"; // Filtrar por producto
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Proveedores - Producto Playo</title>
    <link rel="stylesheet" type="text/css" href="css/proveedortablas.css">
</head>
<body>
    <div id="header">
        <a><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>
    </div>

    <div id="body">
        <div>
            <ul id="navigation">
                <li><a href="Separador.php" class="link1">Inicio</a></li>
                <li><a href="reg_proveedor.php" class="link1">Registro De Proveedores</a></li>
                <li><a href="proveedores.php" class="link1">Proveedores</a></li>
                <li><a href="historial_proveedor.php" class="link1">Historial De Proveedores</a></li>
                <li><a href="logout.php" class="link2">Cerrar Sesión</a></li>
            </ul>
        </div>

        <div id="content">
            <h1>Proveedores con Producto 'Playo'</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID Proveedor</th>
                        <th>Nombre</th>
                        <th>Constancia Fiscal</th>
                        <th>Razón</th>
                        <th>Régimen</th>
                        <th>RFC</th>
                        <th>Domicilio Fiscal</th>
                        <th>Domicilio Operativo</th>
                        <th>Contacto</th>
                        <th>Correo</th>
                        <th>Lista</th>
                        <th>Producto</th>
                        <th>Ciudad</th>
                        <th>Anotaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["ID_Proveedor"]) . "</td>"; 
                            echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["constancia_fiscal"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["razon"]) . "</td>"; 
                            echo "<td>" . htmlspecialchars($row["regimen"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["rfc"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["domicilio_fiscal"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["domicilio_operativo"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["contacto"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["correo"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["lista"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["producto"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["ciudad"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["anotaciones"]) . "</td>";
                            echo "<td>
                                    <a href='actualizarPro.php?id=" . htmlspecialchars($row["ID_Proveedor"]) . "' class='btn btn-update'>Actualizar</a> | 
                                    <a href='borrarPro.php?id=" . htmlspecialchars($row["ID_Proveedor"]) . "' class='btn btn-delete' onclick='return confirm(\"¿Estás seguro de que deseas borrar este proveedor?\")'>Borrar</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='15'>No hay proveedores disponibles para el producto 'Playo'.</td></tr>";
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
                                <img src="images/GrupoAlma.png" width="65" alt="Grupo Almatodo">
                            </a>
                        </div>
                        <p>
                            &copy; GRUPO ALMATODO S.A.S. DE C.V.
                        </p>
                    </body>
                    </html>
                    
                    <?php
                    $conn->close();  // Cerrar la conexión a la base de datos al final
                    ?>