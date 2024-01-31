<?php
echo "Se ejecutó procesar_reserva.php"; // Agrega esta línea
require_once('conexion.php');
$dni = isset($_SESSION['DNI']) ? $_SESSION['DNI'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    aplicarCambios($conn, $dni);
}

function aplicarCambios($conn, $dni) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar si se están enviando datos para crear una nueva reserva
        $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
        $nombre_cliente_nuevo = $conn->real_escape_string($_POST['nombre']);
        $contacto_nuevo = $conn->real_escape_string($_POST['contacto']);
        $fecha_reserva_nuevo = $conn->real_escape_string($_POST['fecha']);
        $hora_reserva_nuevo = $conn->real_escape_string($_POST['hora']);
        $num_personas_nuevo = $conn->real_escape_string($_POST['num_personas']);
        $mesa_id_nuevo = $conn->real_escape_string($_POST['mesa_id']);
        $estado_nuevo = isset($_POST['estado']) ? $conn->real_escape_string($_POST['estado']) : 'Pendiente';
        $Observaciones_nuevo = $conn->real_escape_string($_POST['Observaciones']);
        $dni = isset($_POST['DNI']) ? $conn->real_escape_string($_POST['DNI']) : '';

        // Query para insertar una nueva reserva (utilizando sentencias preparadas)
        $sqlInsert = "INSERT INTO reservas (id, nombre_cliente, contacto, fecha_reserva, hora_reserva, num_personas, mesa_id, estado, DNI, Observaciones) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sqlInsert);
        $stmt->bind_param('ssssssssss', $id, $nombre_cliente_nuevo, $contacto_nuevo, $fecha_reserva_nuevo, $hora_reserva_nuevo, 
                          $num_personas_nuevo, $mesa_id_nuevo, $estado_nuevo, $dni, $Observaciones_nuevo);

        if ($stmt->execute()) {
            header('Location: paginareservas.php?sec=reservas.php');
            exit; // Añadido para asegurar que la ejecución se detenga después de la redirección
        } else {
            echo "Error al crear la reserva: " . $stmt->error;
        }

        $stmt->close(); // Cerrar la declaración preparada
        $conn->close(); // Cerrar la conexión
    }
}
?>

