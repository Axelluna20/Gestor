<?php
// borrar.php

// Incluir la conexión a la base de datos
include 'conexionNP.php';

// Verificar si se envía el ID
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Usar una sentencia preparada para eliminar el registro
    $deleteSql = "DELETE FROM cotizaciones WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: historial_cotizaciones.php?status=success");
            exit();
        } else {
            header("Location: historial_cotizaciones.php?status=error");
            exit();
        }
        $stmt->close();
    } else {
        header("Location: historial_cotizaciones.php?status=error");
        exit();
    }
} else {
    header("Location: historial_cotizaciones.php?status=invalid_id");
    exit();
}

$conn->close();  // Cerrar la conexión a la base de datos
?>
