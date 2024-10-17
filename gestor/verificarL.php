<?php
session_start(); // Iniciar la sesión

// Incluir archivo de conexión
include 'conexionL.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['username'];
    $contrasena = $_POST['contraseña'];

    // Consultar el usuario en la base de datos
    $sql = "SELECT * FROM registro WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si el usuario existe
    if ($resultado->num_rows > 0) {
        // Si el usuario existe, obtener los datos
        $fila = $resultado->fetch_assoc();

        // Guardar el usuario en la sesión
        $_SESSION['usuario'] = $usuario;

        // Credenciales válidas, redirigir a nuevos prosp.php
        echo "<script>
                alert('Inicio de sesión exitoso.');
                window.location.href='nuevos prosp.php';
              </script>";
        exit();
    } else {
        // Usuario o contraseña incorrectos, mostrar alerta
        echo "<script>
                alert('Usuario o contraseña incorrectos. Inténtalo de nuevo.');
                window.location.href='login.html'; // Redirigir al formulario de login
              </script>";
        exit();
    }

    // Cerrar la conexión y el statement
    $stmt->close();
    $conn->close();
}
?>
