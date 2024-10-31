<?php
session_start();
session_unset();  // Eliminar todas las variables de sesión
session_destroy();  // Destruir la sesión actual

// Desactivar caché para evitar que las páginas se puedan ver usando la flecha de regreso del navegador
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Redirigir al usuario a la página de inicio de sesión
header("Location: login.html");
exit();
?>
