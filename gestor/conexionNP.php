<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia si es necesario
$usuario = 'root'; // Tu usuario de base de datos
$contrasena = ''; // Tu contraseña de base de datos
$base_datos = 'gestor'; // Nombre de tu base de datos

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
    $proveedor = $_POST['proveedor'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];
    $constancia = $_POST['constancia']; // Opcional

    // Consulta para registrar el prospecto
    $sql = "INSERT INTO nuevo_prospecto (nombre, empresa, producto, caracteristicas, proveedor, numero, direccion, constancia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Verifica que la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular parámetros
        $stmt->bind_param("ssssssss", $nombre, $empresa, $producto, $caracteristicas, $proveedor, $numero, $direccion, $constancia);
        
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

    // Mostrar el mensaje directamente en la página
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Resultado de Guardado</title>
    </head>
    <body>
        <h2>$mensaje</h2>
        <p>Serás redirigido a la página anterior. Si no, haz clic en el siguiente enlace: <a href='nuevos prosp.php'>Volver</a></p>
        <meta http-equiv='refresh' content='5;url=nuevos prosp.php'> <!-- Redirige después de 5 segundos -->
    </body>
    </html>";
    exit; // Asegúrate de salir después de mostrar el mensaje
}
?>
