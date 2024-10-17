<?php
session_start();

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
<!-- Indica que el documento es un archivo HTML5 -->

<html>
<!-- Comienza el elemento raíz del documento HTML -->

<head>
    <meta charset="UTF-8">
    <!-- Establece el conjunto de caracteres del documento a UTF-8 para soportar caracteres especiales -->

    <title>nuevos_prospectos</title>
    <!-- Define el título de la página que aparecerá en la pestaña del navegador -->

    <link rel="stylesheet" type="text/css" href="css/nuevos prosp.css">
    <!-- Enlaza un archivo CSS externo para aplicar estilos a la página -->
</head>
<!-- Cierra la sección <head> -->

<body>
<!-- Comienza el cuerpo del documento, donde se coloca el contenido visible -->

    <div id="header">
    <!-- Abre un contenedor para el encabezado de la página -->

        <a href="index.html"><img src="images/logo.png" alt="Logo"></a>
        <!-- Crea un enlace que lleva a la página index.html y contiene una imagen que sirve como logo -->
    </div>
    <!-- Cierra el contenedor del encabezado -->

    <div id="body">
    <!-- Abre un contenedor para el cuerpo principal del contenido -->

        <div>
        <!-- Abre un contenedor interno para organizar el contenido -->

            <ul id="navigation">
            <!-- Comienza una lista desordenada para los enlaces de navegación -->

                <li class="current">
                <!-- Abre un elemento de lista y lo marca como "actual" para resaltar la página actual -->

                    <a href="nuevos prosp.php" class="link2">Registrar Nuevos Prospectos</a>
                    <!-- Crea un enlace que lleva a nuevos prosp.html con el texto correspondiente -->
                </li>
                <!-- Cierra el elemento de lista -->

                <li>
                <!-- Abre otro elemento de lista -->

                    <a href="ventas mensuales.html" class="link1">Registro De Ventas Mensuales</a>
                    <!-- Crea un enlace que lleva a ventas mensuales.html -->
                </li>
                <!-- Cierra el elemento de lista -->

                <li>
                    <!-- Abre otro elemento de lista -->
    
                        <a href="prospectos mensuales.html" class="link2">Prospectos Mensuales</a>
                        <!-- Crea un enlace que lleva a prospectos mensuales.html -->
                    </li>
                    <!-- Cierra el elemento de lista -->
    
                    <li>
                    <!-- Abre otro elemento de lista -->
    
                        <a href="contacto.html" class="link1">Contactos</a>
                        <!-- Crea un enlace que lleva a contacto.html -->
                    </li>
                    <!-- Cierra el elemento de lista -->
    
                </ul>
                <!-- Cierra la lista de navegación -->
    
            </div>
            <!-- Cierra el contenedor interno -->
    
            <div>
            <!-- Abre un nuevo contenedor para el formulario -->
    
                <form action="conexionN.php" method="POST">
                <!-- Comienza un formulario que envía datos a conexionN.php -->
    
                    <h3>REGISTRO DE NUEVO PROSPECTO</h3>
                    <!-- Encabezado para el formulario -->
    
                    <label for="NOMBRE">NOMBRE:
                        <input type="text" id="NOMBRE" name="nombre" required>
                        <!-- Campo de entrada para el nombre, etiquetado como "NOMBRE" -->
                    </label><br>
    
                    <label for="CORREO">CORREO ELECTRONICO:
                        <input type="email" id="CORREO" name="correo" required>
                        <!-- Campo de entrada para el correo electrónico, etiquetado como "CORREO ELECTRONICO" -->
                    </label><br>
    
                    <label for="NUMERO">NUMERO DE CONTACTO:
                        <input type="text" id="NUMERO" name="numero" required>
                        <!-- Campo de entrada para el número de contacto, etiquetado como "NUMERO DE CONTACTO" -->
                    </label><br>
    
                    <label for="DIRECCION">DIRECCION FISICA:</label>
                    <!-- Etiqueta para el campo de dirección física -->
    
                    <textarea id="DIRECCION" name="direccion" class="auto-adjust" oninput="autoResize(this)" required></textarea>
                    <!-- Campo de texto para la dirección física, con ajuste automático de tamaño -->
    
                    <input type="submit" class="REGISTRAR" value="REGISTRAR PROSPECTO">
                    <input type="submit" class="EDITAR" value="EDITAR PROSPECTO">
                    <input type="submit" class="ACTUALIZAR" value="ACTUALIZAR PROSPECTO">
                    <input type="submit" class="ELIMINAR" value="ELIMINAR PROSPECTO">

                    <!-- Botones para las diferentes acciones -->
                </form>
                <!-- Cierra el formulario -->
    
            </div>
            <!-- Cierra el contenedor del formulario -->
    
        </div>
        <!-- Cierra el contenedor del cuerpo -->
    
        <div id="footer">
        <!-- Abre un contenedor para el pie de página -->
        <div>
            <!-- Abre un contenedor interno para organizar el contenido del pie de página -->
    
                <div id="connect">
                <!-- Abre un contenedor para los enlaces de redes sociales -->
    
                    <h3>Social</h3>
                    <!-- Encabezado para la sección de redes sociales -->
    
                    <a href="http://freewebsitetemplates.com/go/facebook/" id="facebook" target="_blank">Facebook</a>
                    <!-- Enlace a Facebook que se abre en una nueva pestaña -->
    
                    <a href="http://freewebsitetemplates.com/go/twitter/" id="twitter" target="_blank">Twitter</a>
                    <!-- Enlace a Twitter que se abre en una nueva pestaña -->
    
                    <a href="http://freewebsitetemplates.com/go/googleplus/" id="instagram" target="_blank">Google+</a>
                    <!-- Enlace a Google+ que se abre en una nueva pestaña -->
    
                    <a href="https://www.handwaremarket.com/" id="handware" target="_blank">handwaremarket</a>
                    <!-- Enlace a handwaremarket que se abre en una nueva pestaña -->
    
                </div>
                <!-- Cierra el contenedor de redes sociales -->
            </div>
            <!-- Cierra el contenedor interno del pie de página -->
    
            <p>
                &copy; Copyright 2023. All rights reserved.
                <!-- Texto de copyright que indica que todos los derechos están reservados -->
            </p>
        </div>
        <!-- Cierra el contenedor del pie de página -->
    </body>
    </html>
    <!-- Cierra el elemento raíz del documento HTML -->
