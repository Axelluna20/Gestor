<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_apellido = $_POST['nombre_apellido'];
    $correo = $_POST['correo'];
    $departamento = $_POST['departamento'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $usuario = $_POST['usuario'];

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Verificar si el usuario (nombre y apellido) ya existe en la base de datos
    $sql = "SELECT * FROM registro WHERE nombre_apellido = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre_apellido);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "El usuario ya existe. Por favor elige otro.";
    } else {
        // Insertar nuevo usuario en la base de datos
        $sql_insertar = "INSERT INTO registro (nombre_apellido, correo, departamento, contrasena, usuario) VALUES (?, ?, ?, ?, ?)";
        $stmt_insertar = $conexion->prepare($sql_insertar);
        $stmt_insertar->bind_param("sssss", $nombre_apellido, $correo, $departamento, $contrasena, $usuario);

        if ($stmt_insertar->execute()) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . $stmt_insertar->error;
        }
    }

    // Cerrar la conexión y los statements
    $stmt->close();
    $stmt_insertar->close();
    $conexion->close();
}
?>

