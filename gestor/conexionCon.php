<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestor");

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];

    // Preparar la consulta para insertar los datos
    $sql = "INSERT INTO contactos (nombre, correo, numero, direccion) VALUES ('$nombre', '$correo', '$numero', '$direccion')";

    // Ejecutar la consulta y verificar si se insertó correctamente
    if ($conexion->query($sql) === TRUE) {
        // Mostrar una alerta antes de redirigir
        echo "<script>
                alert('La información se ha guardado correctamente. Redirigiendo a la página de contactos...');
                window.location.href = 'contacto.html';
              </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>
