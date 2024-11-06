<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "gestor");

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar las variables
    $vendedor = isset($_POST['vendedor']) ? trim($_POST['vendedor']) : null; // Usar trim para eliminar espacios en blanco
    $fecha_inicio = isset($_POST['fi']) ? trim($_POST['fi']) : null;
    $hora_inicio = isset($_POST['hi']) ? trim($_POST['hi']) : null;
    $fecha_entrega = isset($_POST['ft']) ? trim($_POST['ft']) : null;
    $hora_entrega = isset($_POST['ht']) ? trim($_POST['ht']) : null;
    $gestor = isset($_POST['ges']) ? trim($_POST['ges']) : null;
    $producto = isset($_POST['pro']) ? trim($_POST['pro']) : null;
    $cliente = isset($_POST['cli']) ? trim($_POST['cli']) : null;
    $estatus = isset($_POST['estatus']) ? trim($_POST['estatus']) : null;
    $anotaciones = isset($_POST['anot']) ? trim($_POST['anot']) : null;

    // Verificar si el campo vendedor está vacío
    if (empty($vendedor)) {
        echo "El campo vendedor está vacío.";
    } else {
        // Preparar la consulta para insertar los datos
        $stmt = $conexion->prepare("INSERT INTO cotizaciones (vendedor, fecha_inicio, hora_inicio, fecha_entrega, hora_entrega, gestor, producto, cliente, estatus, anotaciones) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Comprobar si el statement se preparó correctamente
        if ($stmt) {
            // Enlazar los parámetros
            $stmt->bind_param("ssssssssss", $vendedor, $fecha_inicio, $hora_inicio, $fecha_entrega, $hora_entrega, $gestor, $producto, $cliente, $estatus, $anotaciones);

            // Ejecutar la consulta y verificar si se insertó correctamente
            if ($stmt->execute()) {
                // Mostrar una alerta antes de redirigir
                echo "<script>
                        alert('La cotización se ha guardado correctamente. Redirigiendo a la página de COTIZACIONES...');
                        window.location.href = 'contacto.php';
                      </script>";
                exit();
            } else {
                echo "Error al insertar: " . $stmt->error; // Mostrar error específico de la inserción
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error; // Mostrar error en la preparación
        }
    }
}

// Cerrar la conexión
$conexion->close();
?>
