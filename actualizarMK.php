<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestor");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar variables
$id = $nombre = $empresa = $producto = $caracteristicas = $correo = $vendedor = $numero = $direccion = $constancia = $estatus = "";
$actualizado = false; // Variable para verificar si se actualizó correctamente

// Verificar si se ha enviado el ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos del prospecto
    $sql = "SELECT nombre, empresa, producto, caracteristicas, correo, vendedor, numero, direccion, constancia, estatus FROM nuevo_prospecto WHERE ID_Prospecto=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nombre, $empresa, $producto, $caracteristicas, $correo, $vendedor, $numero, $direccion, $constancia, $estatus);

    // Obtener el resultado
    if (!$stmt->fetch()) {
        echo "No se encontró el registro con el ID: $id";
        exit();
    }

    // Cerrar la declaración
    $stmt->close();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $empresa = $_POST['empresa'];
    $producto = $_POST['producto'];
    $caracteristicas = $_POST['caracteristicas'];
    $correo = $_POST['correo'];
    $vendedor = $_POST['vendedor'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];
    $constancia = $_POST['constancia'];
    $estatus = $_POST['estatus'];

    // Consulta para actualizar los datos en la tabla nuevo_prospecto
    $sql = "UPDATE nuevo_prospecto SET nombre=?, empresa=?, producto=?, caracteristicas=?, correo=?, vendedor=?, numero=?, direccion=?, constancia=?, estatus=? WHERE ID_Prospecto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssssi", $nombre, $empresa, $producto, $caracteristicas, $correo, $vendedor, $numero, $direccion, $constancia, $estatus, $id);


    // Ejecutar la consulta
    if ($stmt->execute()) {
        $actualizado = true;
        header("Location: prospectos mensuales.php");
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
    <link rel="stylesheet" type="text/css" href="css/actualizar.css">
</head>
<body>
    <h1 style="color: white; text-align: center;">Actualizar Prospecto</h1>
    <div>
        <form method="POST" action="actualizarMK.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
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

            <label for="estatus">STATUS:</label>
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
            
            <input type="submit" value="Actualizar">
        </form>
        <?php if ($actualizado): ?>
            <p>¡Registro actualizado correctamente!</p>
        <?php endif; ?>
    </div>
</body>
</html>
