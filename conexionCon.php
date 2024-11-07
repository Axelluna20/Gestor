<?php
// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// Consultar la información de la tabla 'proveedores'
$sql = "SELECT ID_Proveedor, nombre, constancia_fiscal, razon, regimen, rfc, domicilio_fiscal, domicilio_operativo, contacto, correo, lista, producto, ciudad FROM proveedores WHERE producto = 'Playo'";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Almacenar resultados en un array
$cotizaciones = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cotizaciones[] = $row; // Agrega cada fila al array
    }
}

// Inserción de nuevo proveedor
if (isset($_POST['nombre'], $_POST['constancia_fiscal'], $_POST['razon'], $_POST['regimen'], $_POST['rfc'], $_POST['domicilio_fiscal'], $_POST['domicilio_operativo'], $_POST['contacto'], $_POST['correo'], $_POST['lista'], $_POST['producto'], $_POST['ciudad'])) {
    // Preparar la consulta de inserción
    $stmt = $conn->prepare("INSERT INTO proveedores (nombre, constancia_fiscal, razon, regimen, rfc, domicilio_fiscal, domicilio_operativo, contacto, correo, lista, producto, ciudad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Verificar si la consulta se preparó correctamente
    if ($stmt) {
        // Asignar valores a los parámetros
        $stmt->bind_param("ssssssssssss", $_POST['nombre'], $_POST['constancia_fiscal'], $_POST['razon'], $_POST['regimen'], $_POST['rfc'], $_POST['domicilio_fiscal'], $_POST['domicilio_operativo'], $_POST['contacto'], $_POST['correo'], $_POST['lista'], $_POST['producto'], $_POST['ciudad']);

        // Ejecutar la consulta y verificar si se insertó correctamente
        if ($stmt->execute()) {
            // Mostrar una alerta antes de redirigir
            echo "<script>
                    alert('El Proveedor se ha guardado correctamente. Redirigiendo a la página de proveedores...');
                    window.location.href = 'proveedores.php';
                  </script>";
            exit();
        } else {
            echo "Error al insertar: " . $stmt->error; // Mostrar error específico de la inserción
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}

// No cerrar la conexión aquí para usarla en el archivo principal
?>
