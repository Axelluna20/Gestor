<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la conexión esté establecida aquí

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id = $_POST['id'];

    // Consulta para obtener datos de la tabla nuevo_prospecto
    $sql_select = "SELECT nombre, empresa, producto FROM nuevo_prospecto WHERE ID_Prospecto='$id'";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows > 0) {
        // Si hay resultados, obtener los datos
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $empresa = $row['empresa'];
        $producto = $row['producto'];

        // Actualizar información en la tabla ventas_mensuales
        $sql_update = "UPDATE ventas_mensuales SET nombre='$nombre', empresa='$empresa', producto='$producto' WHERE ID='$id'";

        // Ejecutar la consulta de actualización
        if ($conn->query($sql_update) === TRUE) {
            echo "Registro actualizado correctamente.";
        } else {
            echo "Error actualizando registro: " . $conn->error;
        }
    } else {
        echo "No se encontró el prospecto.";
    }
}

// No cierres la conexión aquí si necesitas seguir usando $conn en otros archivos
// $conn->close();
?>
