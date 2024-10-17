<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // Por defecto en WampServer
$password = ""; // Por defecto es vacío
$dbname = "gestor"; // Tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $nueva_contraseña = $conn->real_escape_string($_POST['nueva_contraseña']);
    $confirmar_contraseña = $conn->real_escape_string($_POST['confirmar_contraseña']);

    // Verificar si las contraseñas coinciden
    if ($nueva_contraseña !== $confirmar_contraseña) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
        exit;
    }

    // Consultar si el usuario existe en la base de datos
    $sql = "SELECT * FROM registro WHERE usuario = '$usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // Actualizar la contraseña en la base de datos
        $sql_update = "UPDATE registro SET contrasena = '$nueva_contraseña' WHERE usuario = '$usuario'";
        
        if ($conn->query($sql_update) === TRUE) {
            echo "<script>alert('Contraseña restablecida exitosamente.'); window.location.href='login.html';</script>";
        } else {
            echo "<script>alert('Error al actualizar la contraseña.');</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('El usuario no existe.');</script>";
    }
}

// Cerrar conexión
$conn->close();
?>
