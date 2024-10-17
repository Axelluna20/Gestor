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
    $nombre_apellido = $conn->real_escape_string($_POST['nombre_apellido']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $departamento = $conn->real_escape_string($_POST['departamento']);
    $contrasena = $conn->real_escape_string($_POST['contrasena']);
    $confirmar_contrasena = $conn->real_escape_string($_POST['confirmar_contrasena']);
    $usuario = $conn->real_escape_string($_POST['usuario']);

    // Verificar si algún campo está vacío
    if (empty($nombre_apellido) || empty($correo) || empty($departamento) || empty($contrasena) || empty($confirmar_contrasena) || empty($usuario)) {
        echo "<script>
                alert('Todos los campos son obligatorios. Por favor, completa el formulario.');
                window.history.back();
              </script>";
        exit;
    }

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirmar_contrasena) {
        echo "<script>
                alert('Las contraseñas no coinciden. Por favor, verifica.');
                window.history.back();
              </script>";
        exit;
    }

    // Insertar datos en la tabla 'registro'
    $sql = "INSERT INTO registro (nombre_apellido, correo, departamento, contrasena, usuario) 
            VALUES ('$nombre_apellido', '$correo', '$departamento', '$contrasena', '$usuario')";

    if ($conn->query($sql) === TRUE) {
        // Mostrar alerta y redirigir al login
        echo "<script>
                alert('Registrado exitosamente');
                window.location.href = 'login.html';
              </script>";
    } else {
        echo "<script>
                alert('Error al registrar el usuario: " . $conn->error . "');
                window.history.back();
              </script>";
    }
}

// Cerrar conexión
$conn->close();
?>
