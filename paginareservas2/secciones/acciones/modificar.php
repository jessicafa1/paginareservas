<?php
require('conexion.php');

// Obtén el ID de la reserva que deseas modificar
$reservaId = isset($_GET['id']) ? $_GET['id'] : null;


// Si tienes un ID válido, incluye el archivo de modificación
if ($reservaId) {
    include_once('modificar.php');
}
// Asignar la conexión a $miPDO
$miPDO = $conn;

// Verificar si la conexión a la base de datos fue exitosa
if (!$miPDO) {
    echo "Error en la conexión a la base de datos.";
    exit();
}

// Obtener el ID del registro a modificar desde la URL
$reservaId = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se recibió una solicitud POST, actualizar el registro
    if (isset($_POST['actualizar'])) {
        $reservaId = $_POST['reserva_id'];
        $nombre_cliente = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $fecha_reserva = $_POST['fecha'];
        $hora_reserva = $_POST['hora'];
        $num_personas = $_POST['num_personas'];
        $mesa_id = $_POST['mesa_id'];
        $estado = $_POST['estado'];
        $dni = $_POST['DNI'];
        $observaciones = $_POST['Observaciones'];

        $stmt = $miPDO->prepare("UPDATE reservas SET nombre_cliente=?, contacto=?, fecha_reserva=?, hora_reserva=?, num_personas=?, mesa_id=?, estado=?, dni=?, observaciones=? WHERE id=?");
        $stmt->bind_param('ssssissssi', $nombre_cliente, $contacto, $fecha_reserva, $hora_reserva, $num_personas, $mesa_id, $estado, $dni, $observaciones, $reservaId);
        $stmt->execute();

        header("Location: paginareservas.php?sec=reservas.php&vistas=vistageneral.php");
        exit();
    }
}

// Validar que se haya proporcionado un ID válido
if (!$reservaId) {
    echo "ID de reserva no proporcionado.";
    exit();
}

// Preparar SELECT para obtener los datos del registro actual
$miConsulta = $miPDO->prepare('SELECT * FROM reservas WHERE id = ?');
$miConsulta->bind_param('i', $reservaId);
$miConsulta->execute();
$miResultado = $miConsulta->get_result(); // Obtener el resultado

// Verificar si se encontró el registro
if ($miResultado) {
    $registro = $miResultado->fetch_assoc(); // Utilizar fetch_assoc para MySQLi

    if (!$registro) {
        echo "Registro no encontrado.";
        exit();
    }
} else {
    echo "Error al obtener el resultado.";
    exit();
}
?>

<!-- Formulario para modificar el registro -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar - CRUD PHP</title>
    <style>
/** */
    </style>
</head>
<body>

<div id="popup-overlay2" ></div>
    <div  id="popup2" >
    <button onclick="cerrarPopup()">Volver</button>
    <form method="POST" action="modificar.php">

        <input type="hidden" name="reserva_id" value="<?= $reservaId ?>">
        <!-- Eliminé el campo id -->

        <label for="nombre">Nombre del Cliente:</label>
        <input type="text" name="nombre" value="<?php echo $registro['nombre_cliente']; ?>" >

        <label for="contacto">Contacto:</label>
        <input type="text" name="contacto" value="<?php echo $registro['contacto']; ?>" >

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="<?php echo $registro['fecha_reserva']; ?>" >

        <label for="hora">Hora:</label>
        <input type="time" name="hora" value="<?php echo $registro['hora_reserva']; ?>" >

        <label for="num_personas">Número de personas:</label>
        <input type="number" name="num_personas" value="<?php echo $registro['num_personas']; ?>" >

        <label for="mesa_id">Número de mesa:</label>
        <input type="number" name="mesa_id" value="<?php echo $registro['mesa_id']; ?>" >

        <label for="Observaciones">Observaciones:</label>
        <textarea name="Observaciones"><?php echo $registro['Observaciones']; ?></textarea>

        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="Pendiente" <?php echo ($registro['estado'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
            <option value="Confirmado" <?php echo ($registro['estado'] == 'Confirmado') ? 'selected' : ''; ?>>Confirmado</option>
            <option value="Anulado" <?php echo ($registro['estado'] == 'Anulado') ? 'selected' : ''; ?>>Anulado</option>
        </select>

        <input type="hidden" name="DNI" value="<?php echo $registro['DNI']; ?>">

        <input type="submit" name="actualizar" value="Modificar">
    </form>
</div>
<script>

function cerrarPopup() {
    window.location.href = 'paginareservas.php?sec=reservas.php';
        }
    </script>

</body>
</html>
