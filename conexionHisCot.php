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

// Consultar la información de la tabla 'cotizaciones'
$sql = "SELECT id, vendedor, fecha_inicio, fecha_entrega, cliente, producto, estatus FROM cotizaciones WHERE estatus = 'Cliente fidelizado'";
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

// Suponiendo que recibimos datos para actualizar desde un formulario o similar
if (isset($_POST['vendedor'], $_POST['fecha_inicio'], $_POST['fecha_entrega'], $_POST['hora_inicio'], $_POST['hora_entrega'], $_POST['gestor'], $_POST['producto'], $_POST['cliente'], $_POST['estatus'], $_POST['anotaciones'], $_POST['id'])) {
    // Escapar y sanitizar los datos
    $id = (int)$_POST['id']; // Asegurarse de que $id sea un entero
    $vendedor = $conn->real_escape_string($_POST['vendedor']);
    $fecha_inicio = $conn->real_escape_string($_POST['fecha_inicio']);
    $hora_inicio = $conn->real_escape_string($_POST['hora_inicio']);
    $fecha_entrega = $conn->real_escape_string($_POST['fecha_entrega']);
    $hora_entrega = $conn->real_escape_string($_POST['hora_entrega']);
    $gestor = $conn->real_escape_string($_POST['gestor']);
    $producto = $conn->real_escape_string($_POST['producto']);
    $cliente = $conn->real_escape_string($_POST['cliente']);
    $estatus = $conn->real_escape_string($_POST['estatus']);
    $anotaciones = $conn->real_escape_string($_POST['anotaciones'] ?? '');

    // Actualizar información en la tabla cotizaciones
    $sql_update = "UPDATE cotizaciones SET vendedor='$vendedor', fecha_inicio='$fecha_inicio', fecha_entrega='$fecha_entrega', cliente='$cliente', producto='$producto', estatus='$estatus' WHERE id='$id'";

    // Ejecutar la consulta de actualización
    if ($conn->query($sql_update) === TRUE) {
        $_SESSION['mensaje'] = "Registro actualizado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error actualizando registro: " . $conn->error;
    }

    // Redirigir a la página de historial de cotizaciones
    header("Location: historial_cotizaciones.php");
    exit();
}

// No cerrar la conexión aquí para usarla en el archivo principal
?>