<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexionR.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $nueva_contraseña = $_POST['nueva_contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    // Redirigir a conexionR.php pasando los datos del formulario
    header("Location: conexionR.php?usuario=$usuario&nueva_contraseña=$nueva_contraseña&confirmar_contraseña=$confirmar_contraseña");
    exit();
}
?>
