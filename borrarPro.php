<?php
// borrar.php

// Incluir la conexión a la base de datos
include 'conexionPro.php';

// Verificar si se envía el ID
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Usar una sentencia preparada para eliminar el registro
    $deleteSql = "DELETE FROM proveedores WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: proveedores.php?status=success");
            exit();
        } else {
            header("Location: proveedores.php?status=error");
            exit();
        }
        $stmt->close();
    } else {
        header("Location: proveedores.php?status=error");
        exit();
    }
} else {
    header("Location: proveedores.php?status=invalid_id");
    exit();
}

$conn->close();  // Cerrar la conexión a la base de datos
?>
