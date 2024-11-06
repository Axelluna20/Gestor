<?php
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contactos</title>
    <link rel="stylesheet" type="text/css" href="css/contactos.css">
</head>
<body>
    <div id="header">
        <a href="#"><img src="images/Grupo_Almatodo_sin_fondo.png" width="150" alt="Logo"></a>
    </div>

    <!-- Menú de navegación -->
    <ul id="navigation">
    <li><a href="Separador.php" class="link1">Inicio</a></li>
                <li><a href="contacto.php" class="link1">Cotizaciones(Compras)</a></li>
                <li><a href="historial_cotizaciones.php" class="link1">Cotizaciones</a></li>
                <li><a href="historialCot.php" class="link1">Historial De Cotizaciones</a></li>
                <li><a href="logout.php" class="link2">Cerrar Sesión</a></li>
    </ul>

    <div id="body">
        <div id="contact">
            <form action="conexionCon.php" method="POST" style="max-width: 500px; margin: auto; font-family: Arial, sans-serif;">
                <h3 style="color: #02164d; text-align: center;">SEGUIMIENTO DE COMPRAS</h3>

                <label for="vendedor" style="color: #02164d;">Vendedor:</label>
                <input type="text" id="vendedor" name="vendedor" required><br><br>

                <label for="fi" style="color: #02164d;">Fecha de inicio de solicitud:</label>
                <input type="date" id="fi" name="fi" required><br><br>

                <label for="hi" style="color: #02164d;">Hora de inicio de solicitud:</label>
                <input type="time" id="hi" name="hi" required><br><br>

                <label for="ft" style="color: #02164d;">Fecha de entrega de cotización:</label>
                <input type="date" id="ft" name="ft" required><br><br>

                <label for="ht" style="color: #02164d;">Hora de entrega de cotización:</label>
                <input type="time" id="ht" name="ht" required><br><br>

                <label for="ges" style="color: #02164d;">Gestor de cotización:</label>
                <input type="text" id="ges" name="ges" required><br><br>

                <label for="pro" style="color: #02164d;">Producto:</label>
                <input type="text" id="pro" name="pro" required><br><br>

                <label for="cli" style="color: #02164d;">Cliente:</label>
                <input type="text" id="cli" name="cli" required><br><br>

                <label for="estatus" style="color: #02164d;">Status:</label>
                <select name="estatus" id="estatus" required>
                    <option value="">--Seleccione--</option>
                    <option value="Por contactar">Por contactar</option>
                    <option value="Contactado">Contactado</option>
                    <option value="Sin contestar">Sin contestar</option>
                    <option value="Solicitó cotización">Solicitó cotización</option>
                    <option value="Negociando cotización">Negociando cotización</option>
                    <option value="Cliente fidelizado">Cliente Finalizado</option>
                    <option value="Descartado">Descartado</option>
                    <option value="Cerrado">Cerrado</option>
                </select><br><br>

                <label for="anot" style="color: #02164d;">Anotaciones:</label>
                <textarea id="anot" name="anot" class="auto-adjust" required></textarea><br><br>

                <button type="submit" style="background-color: #02164d; color: white; padding: 10px 20px; border: none; cursor: pointer;">GUARDAR cotización</button>
            </form>
        </div>
    </div>

    <div id="connect">
        <h3>Social</h3>
        <a href="https://www.facebook.com/GrupoAlmatodo?mibextid=ZbWKwL" target="_blank">
            <img src="images/facebook.png" width="100" alt="Facebook">
        </a>
        <a href="https://www.instagram.com/grupoalmatodo_mex?igsh=MTJuMHl0YTAxa3czNQ==" target="_blank">
            <img src="images/instagram.png" width="100" alt="Instagram">
        </a>
        <a href="https://www.tiktok.com/@grupoalmatodo?_t=8qvcwgLRpdF&_r=1" target="_blank">
            <img src="images/logotik.png" width="60" alt="Tik Tok">
        </a>
        <a href="https://www.handwaremarket.com/" target="_blank">
            <img src="images/Hardware.png" width="65" alt="Handware Market">
        </a>
        <a href="https://grupoalmatodo.com/" target="_blank">
            <img src="images/GrupoAlma.png" width="65" alt="Grupo Almatodo">
        </a>
    </div>
    
    <p>&copy; GRUPO ALMATODO S.A.S. DE C.V.</p>
</body>
</html>
