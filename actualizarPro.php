<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestor");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar variables
$ID_Proveedor = $nombre = $constancia_fiscal = $razon = $regimen = $rfc = $domicilio_fiscal = $domicilio_operativo = $contacto = $correo = $lista = $producto = $ciudad = $anotaciones = "";
$actualizado = false;

// Verificar si se ha enviado el ID por GET
if (isset($_GET['id'])) {
    $ID_Proveedor = $_GET['id'];

    // Consulta para obtener los datos del registro en la tabla proveedores
    $sql = "SELECT nombre, constancia_fiscal, razon, regimen, rfc, domicilio_fiscal, domicilio_operativo, contacto, correo, lista, producto, ciudad, anotaciones FROM proveedores WHERE ID_Proveedor = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $ID_Proveedor);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontró el registro
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nombre, $constancia_fiscal, $razon, $regimen, $rfc, $domicilio_fiscal, $domicilio_operativo, $contacto, $correo, $lista, $producto, $ciudad, $anotaciones);
        $stmt->fetch();
    } else {
        echo "No se encontró el registro con el ID: $ID_Proveedor";
        exit();
    }

    $stmt->close();
} else {
    echo "ID no especificado en la URL";
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_Proveedor'])) {
    $ID_Proveedor = $_POST['ID_Proveedor'];
    $nombre = $_POST['nombre'];
    $constancia_fiscal = $_POST['constancia_fiscal'];
    $razon = $_POST['razon'];
    $regimen = $_POST['regimen'];
    $rfc = $_POST['rfc'];
    $domicilio_fiscal = $_POST['domicilio_fiscal'];
    $domicilio_operativo = $_POST['domicilio_operativo'];
    $contacto = $_POST['contacto'];
    $correo = $_POST['correo'];
    $lista = $_POST['lista'] ?? '';
    $producto = $_POST['producto'];
    $ciudad = $_POST['ciudad'];
    $anotaciones = $_POST['anotaciones'] ?? '';

    // Consulta para actualizar los datos en la tabla proveedores
    $sql = "UPDATE proveedores SET nombre=?, constancia_fiscal=?, razon=?, regimen=?, rfc=?, domicilio_fiscal=?, domicilio_operativo=?, contacto=?, correo=?, lista=?, producto=?, ciudad=?, anotaciones=? WHERE ID_Proveedor=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssssssssssi", $nombre, $constancia_fiscal, $razon, $regimen, $rfc, $domicilio_fiscal, $domicilio_operativo, $contacto, $correo, $lista, $producto, $ciudad, $anotaciones, $ID_Proveedor);

    if ($stmt->execute()) {
        $actualizado = true;
        header("Location: proveedores.php");
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
    <title>Actualizar Producto</title>
    <link rel="stylesheet" type="text/css" href="css/actualizarPro.css">
</head>
<body>
    <h1 style="color: white; text-align: center;">Actualizar Productos</h1>
    <div>
        <form method="POST" action="">
            <input type="hidden" name="ID_Proveedor" value="<?php echo $ID_Proveedor; ?>">
            <label for="nombre" style="color: #02164d;">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required><br><br>

            <label for="constancia_fiscal" style="color: #02164d;">Constancia Fiscal:</label>
            <input type="text" id="constancia_fiscal" name="constancia_fiscal" value="<?php echo htmlspecialchars($constancia_fiscal); ?>" required><br><br>

            <label for="razon" style="color: #02164d;">Razón Social:</label>
            <input type="text" id="razon" name="razon" value="<?php echo htmlspecialchars($razon); ?>" required><br><br>

            <label for="regimen" style="color: #02164d;">Regimen Fiscal:</label>
            <input type="text" id="regimen" name="regimen" value="<?php echo htmlspecialchars($regimen); ?>" required><br><br>

            <label for="rfc" style="color: #02164d;">RFC:</label>
            <input type="text" id="rfc" name="rfc" value="<?php echo htmlspecialchars($rfc); ?>" required><br><br>

            <label for="domicilio_fiscal" style="color: #02164d;">Domicilio Fiscal:</label>
            <input type="text" id="domicilio_fiscal" name="domicilio_fiscal" value="<?php echo htmlspecialchars($domicilio_fiscal); ?>" required><br><br>

            <label for="domicilio_operativo" style="color: #02164d;">Domicilio Operativo:</label>
            <input type="text" id="domicilio_operativo" name="domicilio_operativo" value="<?php echo htmlspecialchars($domicilio_operativo); ?>" required><br><br>

            <label for="contacto" style="color: #02164d;">Contacto:</label>
            <input type="text" id="contacto" name="contacto" value="<?php echo htmlspecialchars($contacto); ?>" required><br><br>

            <label for="correo" style="color: #02164d;">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required><br><br>

            <label for="lista" style="color: #02164d;">Lista:</label>
            <input type="text" id="lista" name="lista" value="<?php echo htmlspecialchars($lista); ?>"><br><br>

            <label for="producto" style="color: #02164d;">Producto:</label>
            <input type="text" id="producto" name="producto" value="<?php echo htmlspecialchars($producto); ?>" required><br><br>

            <label for="ciudad" style="color: #02164d;">Estado/Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>" required><br><br>

            <label for="anotaciones" style="color: #02164d;">Anotaciones:</label>
            <textarea id="anotaciones" name="anotaciones"><?php echo htmlspecialchars($anotaciones); ?></textarea><br><br>

            <input type="submit" value="Actualizar">
        </form>
        <?php if ($actualizado): ?>
            <p>¡Registro actualizado correctamente!</p>
        <?php endif; ?>
    </div>
</body>
</html>
