<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvido Contraseña</title>
    <link rel="stylesheet" href="css/estilo.css"> <!-- Enlace a tu CSS -->
    <script>
        function mostrarAlerta(mensaje) {
            alert(mensaje);
        }
    </script>
</head>
<body>
    <header>
        <img src="images/Grupo_Almatodo_sin_fondo.png" alt="Logo">
    </header>
    <div class="container">
        <h2>Olvido Contraseña</h2>
        
        <?php
        // Mostrar alerta si hay un error en la URL
        if (isset($_GET['error']) && $_GET['error'] === 'usuario_no_existe') {
            echo "<script>mostrarAlerta('El usuario no existe.');</script>";
        }
        ?>

        <form action="VerificarRC.php" method="post" onsubmit="return validarFormulario()">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="nueva_contraseña">Nueva Contraseña</label>
                <input type="password" id="nueva_contraseña" name="nueva_contraseña" required>
            </div>
            <div class="form-group">
                <label for="confirmar_contraseña">Confirmar Nueva Contraseña</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
            </div>
            <button type="submit">Restaurar</button>
        </form>
        <div class="links">
            <a href="login.html">Volver al inicio</a>
        </div>
    </div>

    <script>
        function validarFormulario() {
            const usuario = document.getElementById('usuario').value;
            const nuevaContraseña = document.getElementById('nueva_contraseña').value;
            const confirmarContraseña = document.getElementById('confirmar_contraseña').value;

            if (!usuario || !nuevaContraseña || !confirmarContraseña) {
                mostrarAlerta('Todos los campos son obligatorios.');
                return false;
            }

            if (nuevaContraseña !== confirmarContraseña) {
                mostrarAlerta('Las contraseñas no coinciden.');
                return false;
            }

            return true; // El formulario se puede enviar
        }
    </script>
</body>
</html>
