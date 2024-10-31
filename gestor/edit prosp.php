<?php
include 'conexionNP.php';  // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $empresa = trim($_POST['empresa']);
    $producto = trim($_POST['producto']);
    $caracteristicas = trim($_POST['caracteristicas']);
    $proveedor = trim($_POST['proveedor']);
    $correo = trim($_POST['correo']);
    $vendedor = trim($_POST['vendedor']);
    $numero = trim($_POST['numero']);
    $direccion = trim($_POST['direccion']);
    $constancia = trim($_POST['constancia']);

    // Verificar que los campos obligatorios no estén vacíos
    if (empty($nombre) || empty($empresa) || empty($producto) || empty($caracteristicas) || 
        empty($proveedor) || empty($correo) || empty($vendedor) || 
        empty($numero) || empty($direccion) || empty($constancia)) {
        echo "<h3 style='color: red;'>Por favor, llena todos los campos obligatorios.</h3>"; // Mensaje de error
    } else {
        // Actualizar en la base de datos
        $sql_update = "UPDATE nuevo_prospecto SET 
            nombre='$nombre', 
            empresa='$empresa', 
            producto='$producto', 
            caracteristicas='$caracteristicas', 
            proveedor='$proveedor', 
            correo='$correo', 
            vendedor='$vendedor', 
            numero='$numero', 
            direccion='$direccion', 
            constancia='$constancia' 
            WHERE ID_Prospecto='$id'";
        
        if ($conn->query($sql_update) === TRUE) {
            echo "<h3 style='color: green;'>Registro actualizado correctamente.</h3>"; // Mensaje de éxito
        } else {
            echo "<h3 style='color: red;'>Error al actualizar: " . $conn->error . "</h3>"; // Mensaje de error
        }
    }
} else {
    $id = $_GET['id'];  // Obtener el ID del prospecto
    $sql = "SELECT * FROM nuevo_prospecto WHERE ID_Prospecto=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actualizar Prospecto</title>
    <link rel="stylesheet" type="text/css" href="css/actualizar.css">
</head>
<body>
<h1 style="color: white; text-align: center;">Actualizar Prospecto</h1>
    <div>
        <form method="POST" action="actualizar.php">
            <input type="hidden" name="id" value="<?php echo $row['ID_Prospecto']; ?>">
            <label for="nombre" style="color: #02164d;">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" >
            <br>
            <label for="empresa" style="color: #02164d;">Empresa:</label>
            <input type="text" name="empresa" value="<?php echo htmlspecialchars($row['empresa']); ?>" >
            <br>
            <label for="producto" style="color: #02164d;">Producto:</label>
            <input type="text" name="producto" value="<?php echo htmlspecialchars($row['producto']); ?>" >
            <br>

            <label for="caracteristicas" style="color: #02164d;">CARACTERISTICAS:</label>
            <input type="text" name="caracteristicas" value="<?php echo htmlspecialchars($row['caracteristicas']); ?>" >
            <br>

            <label for="proveedor" style="color: #02164d;">PROVEEDOR:</label>
            <input type="text" name="proveedor" value="<?php echo htmlspecialchars($row['proveedor']); ?>" >
            <br>

            <label for="correo" style="color: #02164d;">CORREO:</label>
            <input type="text" name="correo" value="<?php echo htmlspecialchars($row['correo']); ?>" >
            <br>

            <label for="vendedor" style="color: #02164d;">VENDEDOR:</label>
            <input type="text" name="vendedor" value="<?php echo htmlspecialchars($row['vendedor']); ?>" >
            <br>

            <label for="numero" style="color: #02164d;">NUMERO:</label>
            <input type="text" name="numero" value="<?php echo htmlspecialchars($row['numero']); ?>" >
            <br>

            <label for="direccion" style="color: #02164d;">DIRECCION:</label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($row['direccion']); ?>" >
            <br>

            <label for="constancia" style="color: #02164d;">RFC:</label>
            <input type="text" name="constancia" value="<?php echo htmlspecialchars($row['constancia']); ?>" >
            <br>

            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>

<?php
}
$conn->close();  // Cerrar la conexión a la base de datos al final
?>
