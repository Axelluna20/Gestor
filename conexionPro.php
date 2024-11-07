<?php
// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Función para agregar un nuevo proveedor
function agregarProveedor($conn, $nombre, $constancia_fiscal, $razon, $regimen, $rfc, $domicilio_fiscal, $domicilio_operativo, $contacto, $correo, $lista, $producto, $ciudad, $anotaciones) {
    // Escapar y sanitizar los datos
    $nombre = $conn->real_escape_string($nombre);
    $constancia_fiscal = $conn->real_escape_string($constancia_fiscal);
    $razon = $conn->real_escape_string($razon);
    $regimen = $conn->real_escape_string($regimen);
    $rfc = $conn->real_escape_string($rfc);
    $domicilio_fiscal = $conn->real_escape_string($domicilio_fiscal);
    $domicilio_operativo = $conn->real_escape_string($domicilio_operativo);
    $contacto = $conn->real_escape_string($contacto);
    $correo = $conn->real_escape_string($correo);
    $lista = $conn->real_escape_string($lista);
    $producto = $conn->real_escape_string($producto);
    $ciudad = $conn->real_escape_string($ciudad);
    $anotaciones = $conn->real_escape_string($anotaciones);

    // Consulta SQL para insertar un nuevo proveedor
    $sql_insert = "INSERT INTO proveedores (nombre, constancia_fiscal, razon, regimen, rfc, domicilio_fiscal, domicilio_operativo, contacto, correo, lista, producto, ciudad, anotaciones) 
                   VALUES ('$nombre', '$constancia_fiscal', '$razon', '$regimen', '$rfc', '$domicilio_fiscal', '$domicilio_operativo', '$contacto', '$correo', '$lista', '$producto', '$ciudad', '$anotaciones')";

    // Ejecutar la consulta y retornar si fue exitosa o no
    if ($conn->query($sql_insert) === TRUE) {
        return "Proveedor agregado correctamente.";
    } else {
        return "Error al agregar el proveedor: " . $conn->error;
    }
}

// Agregar un nuevo proveedor si se envían datos para añadir
if (isset($_POST['agregar'])) {
    print_r($_POST); // Verifica qué datos se están recibiendo
    $mensaje = agregarProveedor($conn, $_POST['nombre'], $_POST['constancia_fiscal'], $_POST['razon'], $_POST['regimen'], $_POST['rfc'], $_POST['domicilio_fiscal'], $_POST['domicilio_operativo'], $_POST['contacto'], $_POST['correo'], $_POST['lista'], $_POST['producto'], $_POST['ciudad'], $_POST['anotaciones']);
    $_SESSION['mensaje'] = $mensaje;
    header("Location: proveedores.php");
    exit();
}

// No cerrar la conexión aquí para poder reutilizarla en el archivo principal
?>