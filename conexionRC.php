<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$dbname = 'gestor'; // Nombre de tu base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Si no hay contraseña, déjalo vacío

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
