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
?>
