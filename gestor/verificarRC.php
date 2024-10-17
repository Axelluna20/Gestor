<?php
include 'conexionRC.php'; // Asegúrate de que la conexión esté correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario']; // Obtener el nombre del usuario del formulario
    $nueva_contrasena = $_POST['nueva_contraseña']; // Obtener la nueva contraseña del formulario

    // Verificar si el usuario existe en la tabla 'registro'
    $stmt = $pdo->prepare("SELECT * FROM registro WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Actualizar la contraseña directamente sin hashing
        $update_stmt = $pdo->prepare("UPDATE registro SET contrasena = :contrasena WHERE usuario = :usuario");
        $update_stmt->bindParam(':contrasena', $nueva_contrasena); // Usar la nueva contraseña directamente
        $update_stmt->bindParam(':usuario', $usuario); // Para saber a qué usuario actualizar
        
        // Ejecutar la actualización
        if ($update_stmt->execute()) {
            echo "<script>
                    alert('Contraseña actualizada correctamente.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al actualizar la contraseña.');
                    window.location.href = 'login.html';
                  </script>";
        }
    } else {
        echo "<script>
                alert('El usuario no existe.');
                window.location.href = 'login.html';
              </script>";
    }
} else {
    echo "<script>
            alert('Método no permitido.');
            window.location.href = 'login.html';
          </script>";
}
?>