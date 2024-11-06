<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'gestor';

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conn->set_charset("utf8");

// Variable para el mensaje
$mensaje = '';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar todos los campos del formulario
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

    // Consulta para registrar el prospecto
    $sql = "INSERT INTO nuevo_prospecto (nombre, empresa, producto, caracteristicas, correo, vendedor, numero, direccion, constancia, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Verifica que la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular parámetros
        $stmt->bind_param("ssssssssss", $nombre, $empresa, $producto, $caracteristicas, $correo, $vendedor, $numero, $direccion, $constancia, $estatus);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $mensaje = 'Prospecto guardado correctamente.';
        } else {
            $mensaje = 'No se pudo guardar el prospecto: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensaje = 'Error en la preparación de la consulta: ' . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();

    // Redirigir a la página de historial de cotizaciones
    header("Location: prospectos mensuales.php");
    exit();
}
?>
