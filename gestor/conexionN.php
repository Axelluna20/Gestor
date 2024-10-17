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

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    switch ($action) {
        case 'REGISTRAR PROSPECTO':
            // Código para registrar prospecto
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $numero = $_POST['numero'];
            $direccion = $_POST['direccion'];

            // Consulta para registrar el prospecto
            $sql = "INSERT INTO prospectos (nombre, correo, numero, direccion) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $correo, $numero, $direccion);
            if ($stmt->execute()) {
                echo "Prospecto registrado exitosamente.";
            } else {
                echo "Error al registrar prospecto: " . $stmt->error;
            }
            $stmt->close();
            break;

        case 'EDITAR PROSPECTO':
            // Código para editar prospecto
            break;

        case 'ACTUALIZAR PROSPECTO':
            // Código para actualizar prospecto
            break;

        case 'ELIMINAR PROSPECTO':
            // Código para eliminar prospecto
            break;

        default:
            echo "Acción no reconocida.";
            break;
    }
}

// Cerrar la conexión
$conn->close();
?>
