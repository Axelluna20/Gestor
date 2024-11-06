<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php'; // Asegúrate de que el archivo 'conexion.php' establezca la conexión en la variable $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar el ID para prevenir inyecciones SQL
    $id = $conn->real_escape_string($_POST['id']);

    // Consulta para obtener datos de la tabla nuevo_prospecto
    $sql_select = "SELECT nombre, empresa, producto FROM nuevo_prospecto WHERE ID_Prospecto='$id'";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows > 0) {
        // Si hay resultados, obtener los datos
        $row = $result->fetch_assoc();
        $nombre = $conn->real_escape_string($row['nombre']);
        $empresa = $conn->real_escape_string($row['empresa']);
        $producto = $conn->real_escape_string($row['producto']);

        // Actualizar información en la tabla ventas_mensuales
        $sql_update = "UPDATE ventas_mensuales SET nombre='$nombre', empresa='$empresa', producto='$producto' WHERE ID='$id'";

        // Ejecutar la consulta de actualización
    if ($conn->query($sql_update) === TRUE) {
        $_SESSION['mensaje'] = "Registro actualizado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error actualizando registro: " . $conn->error;
    }

    // Redirigir a la página de historial de cotizaciones
    header("Location: prospectos mensuales.php");
    exit();
}
}

// No cierres la conexión aquí si necesitas seguir usando $conn en otros archivos
// $conn->close();
?>
