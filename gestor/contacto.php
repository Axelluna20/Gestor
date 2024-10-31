<?php
session_start();

// Desactivar el caché para evitar volver a páginas anteriores sin iniciar sesión
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contactos</title>
    <link rel="stylesheet" type="text/css" href="css/contactos.css">
    
</head>
<body>
    <div id="header">
        <a><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>
    </div>

    <!-- Menú de navegación -->
    <ul id="navigation">
        <li>
            <a href="nuevos prosp.php" class="link2">Registrar Nuevo Prospecto</a>
        </li>
        <li>
            <a href="ventas mensuales.php" class="link1">Ventas Mensuales</a>
        </li>
        <li>
            <a href="prospectos mensuales.php" class="link2">Prospectos Mensuales</a>
        </li>
        <li class="current">
            <a href="contacto.php" class="link1">Contactos</a>
        </li>
        <li>
            <a href="logout.php" class="link2">Cerrar Sesión</a>
        </li>
    </ul>

    <div id="body">
        <div>
            <div id="contact">
                <h2>REGISTRO DE CONTACTOS</h2>
                <div>
                    <div>
                        <h3>CONTACTOS DE GRUPO ALMATODO</h3>
                        <ul>
                            <li>
                                <span>DIRECCION</span>
                                <p>
                                    CALLE 21 MARZO  #26 COLONIA ZOQUIAPAN C.P.56530, IXTAPALUCA, EDO. DE MEXICO
                                </p>
                            </li>
                            <li>
                                <span>CORREO ELECTRONICO</span>
                                <p>
                                    <a href="mailto:marketing@grupoalmatodo.com">marketing@grupoalmatodo.com</a>
                                </p>
                            </li>
                            <li>
                                <span>TELEFONOS DE CONTACTO GRUPO ALMATODO</span>
                                <p>
                                    UNO: 123 456 789 123
                                </p>
                                <p>
                                    DOS: 123 456 789 123 
                                </p>
                                <p>
                                    TRES: 123 456 789 123
                                </p>
                            </li>
                        </ul>
                    </div>
                    <form action="conexionCon.php" method="POST">
                        <h3>REGISTRO DE NUEVO CONTACTO</h3>
                        <label for="NOMBRE">NOMBRE:
                            <input type="text" id="NOMBRE" name="nombre" required>
                        </label>

                        <label for="CORREO">CORREO ELECTRONICO:
                            <input type="email" id="CORREO" name="correo" required>
                        </label>

                        <label for="NUMERO">NUMERO DE CONTACTO:
                            <input type="tel" id="NUMERO" name="numero" required>
                        </label>

                        <label for="DIRECCION">DIRECCION FISICA:</label>
                        <textarea id="DIRECCION" name="direccion" class="auto-adjust" required></textarea>

                        <input type="submit" class="send" value="GUARDAR CONTACTO">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="connect">
            <h3>Social</h3>
            <a href="https://www.facebook.com/GrupoAlmatodo?mibextid=ZbWKwL " target="_blank">
                <img src="images/facebook.png" width="100" alt="Facebook">
            </a>
            <a href="https://www.instagram.com/grupoalmatodo_mex?igsh=MTJuMHl0YTAxa3czNQ== " target="_blank">
                <img src="images/instagram.png" width="100" alt="Instagram">
            </a>
            <a href="https://www.tiktok.com/@grupoalmatodo?_t=8qvcwgLRpdF&_r=1 " target="_blank">
                <img src="images/logotik.png" width="60" alt="Tik Tok">
            </a>
            <a href="https://www.handwaremarket.com/" target="_blank">
                <img src="images/Hardware.png" width="65" alt="Handware Market"></a>
            </a>
            <a href="https://grupoalmatodo.com/" target="_blank">
                <img src="images/GrupoAlma.png" width="65" alt="Handware Market"></a>
            </a>
        </div>
        </div>
        <p>
            &copy; GRUPO ALMATODO S.A.S. DE C.V.
        </p>
    </div>
</body>
</html>
