<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestor");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar variables
$id = $vendedor = $fecha_inicio = $hora_inicio = $fecha_entrega = $hora_entrega = $gestor = $producto = $cliente = $estatus = $anotaciones = "";
$actualizado = false; // Variable para verificar si se actualizó correctamente

// Verificar si se ha enviado el ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos del registro en la tabla cotizaciones
    $sql = "SELECT vendedor, fecha_inicio, hora_inicio, fecha_entrega, hora_entrega, gestor, producto, cliente, estatus, anotaciones FROM cotizaciones WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontró el registro
    if ($stmt->num_rows > 0) {
        // Asociar variables a los resultados
        $stmt->bind_result($vendedor, $fecha_inicio, $hora_inicio, $fecha_entrega, $hora_entrega, $gestor, $producto, $cliente, $estatus, $anotaciones);
        $stmt->fetch();
    } else {
        echo "No se encontró el registro con el ID: $id";
        exit();
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "ID no especificado en la URL";
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener datos del formulario
    $id = $_POST['id'];
    $vendedor = $_POST['vendedor'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $hora_inicio = $_POST['hora_inicio'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $hora_entrega = $_POST['hora_entrega'];
    $gestor = $_POST['gestor'];
    $producto = $_POST['producto'];
    $cliente = $_POST['cliente'];
    $estatus = $_POST['estatus'];
    $anotaciones = $_POST['anotaciones'] ?? '';

    // Consulta para actualizar los datos en la tabla cotizaciones
    $sql = "UPDATE cotizaciones SET vendedor=?, fecha_inicio=?, hora_inicio=?, fecha_entrega=?, hora_entrega=?, gestor=?, producto=?, cliente=?, estatus=?, anotaciones=? WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssssi", $vendedor, $fecha_inicio, $hora_inicio, $fecha_entrega, $hora_entrega, $gestor, $producto, $cliente, $estatus, $anotaciones, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $actualizado = true;
        header("Location: historial_cotizaciones.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $stmt->error;
    }
    $stmt->close();
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Prospecto</title>
    <link rel="stylesheet" type="text/css" href="css/actualizarHisCot.css">
</head>
<body>
    <h1 style="color: white; text-align: center;">Actualizar Prospecto</h1>
    <div>
        <form method="POST" action="conexionHisCot.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="vendedor" style="color: #02164d;">Vendedor:</label>
            <input type="text" name="vendedor" value="<?php echo htmlspecialchars($vendedor); ?>" required>
            <br>
            <label for="fecha_inicio" style="color: #02164d;">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" value="<?php echo htmlspecialchars($fecha_inicio); ?>" required>
            <br>
            <label for="hora_inicio" style="color: #02164d;">Hora de Inicio:</label>
            <input type="time" name="hora_inicio" value="<?php echo htmlspecialchars($hora_inicio); ?>" required>
            <br>
            <label for="fecha_entrega" style="color: #02164d;">Fecha de Entrega:</label>
            <input type="date" name="fecha_entrega" value="<?php echo htmlspecialchars($fecha_entrega); ?>" required>
            <br>
            <label for="hora_entrega" style="color: #02164d;">Hora de Entrega:</label>
            <input type="time" name="hora_entrega" value="<?php echo htmlspecialchars($hora_entrega); ?>" required>
            <br>
            <label for="gestor" style="color: #02164d;">Gestor:</label>
            <input type="text" name="gestor" value="<?php echo htmlspecialchars($gestor); ?>" required>
            <br>
            <label for="producto" style="color: #02164d;">Producto:</label>
            <input type="text" name="producto" value="<?php echo htmlspecialchars($producto); ?>" required>
            <br>
            <label for="cliente" style="color: #02164d;">Cliente:</label>
            <input type="text" name="cliente" value="<?php echo htmlspecialchars($cliente); ?>" required>
            <br>
            <label for="estatus" style="color: #02164d;">Estatus:</label>
            <select name="estatus" id="estatus" required>
                <option value="">--Seleccione--</option>
                <option value="Por contactar" <?php if ($estatus == "Por contactar") echo "selected"; ?>>Por contactar</option>
                <option value="contactado" <?php if ($estatus == "contactado") echo "selected"; ?>>Contactado</option>
                <option value="sin contestar" <?php if ($estatus == "sin contestar") echo "selected"; ?>>Sin Contestar</option>
                <option value="Solicitó cotizacion" <?php if ($estatus == "Solicitó cotizacion") echo "selected"; ?>>Solicitó Cotización</option>
                <option value="Negociando cotizacion" <?php if ($estatus == "Negociando cotizacion") echo "selected"; ?>>Negociando Cotización</option>
                <option value="Cliente Finalizado" <?php if ($estatus == "Cliente Finalizado") echo "selected"; ?>>Cliente Finalizado</option>
                <option value="Descartado" <?php if ($estatus == "Descartado") echo "selected"; ?>>Descartado</option>
            </select>
            <br>
            <label for="anotaciones" style="color: #02164d;">Anotaciones:</label>
            <textarea name="anotaciones" rows="4" required><?php echo htmlspecialchars($anotaciones); ?></textarea>
            <br>
            <input type="submit" value="Actualizar">
        </form>
        <?php if ($actualizado): ?>
            <p>¡Registro actualizado correctamente!</p>
        <?php endif; ?>
    </div>
</body>
</html>
