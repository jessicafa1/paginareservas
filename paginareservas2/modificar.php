<?php
ob_start(); // Inicia el búfer de salida

require('conexion.php');

// Obtén el ID de la reserva que deseas modificar
$reservaId = isset($_GET['id']) ? $_GET['id'] : null;
$selectedValue = isset($_GET['vistas']) ? $_GET['vistas'] : null;
$vistas = isset($_GET['vistas']) ? $_GET['vistas'] : "vistas/vistageneral.php";
// Si tienes un ID válido, incluye el archivo de modificación
if ($reservaId) {
    include_once('modificar.php');
}
$miPDO = $conn;

if (!$miPDO) {
    echo "Error en la conexión a la base de datos: " . $conn->connect_error;
    exit();
}



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
        $success = $stmt->execute();

        session_start(); // Inicia la sesión
        if ($success) {
            // Almacena el mensaje en una variable de sesión
            $_SESSION['mensaje_exito'] = '¡Su reserva ha sido modificada con éxito!';
            header('Location: paginareservas.php?sec=secciones/reservas.php');
            exit();
        } else {
            echo "Error en la ejecución de la actualización.";
            // Puedes añadir más detalles sobre el error con $stmt->error si es necesario.
        }
        
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar - CRUD PHP</title>
    <link rel="stylesheet" href="estilos/estilo_modificar.css">
</head>
<body>
<!----------------Mensaje reserva modificada--------------------------------- -->
    <div id="contenedor_modificar" >
    <div id="mensaje_check" style="display:none">
                <img src="imagenes/check.gif" alt="Check GIF">
                <p>¡Su reserva ha sido modificada con éxito!</p>
            </div>
<!-----------------------Formulario------------------------------------------- -->
        <div  id="modificar" >
            <button id="volver" onclick="volver()">Volver</button><br>
            
            <form method="POST" action="modificar.php">

        <input type="hidden" name="reserva_id" value="<?= $reservaId ?>">

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
<?php
// Asigna el valor del estado a la variable de sesión
$_SESSION['estado'] = $registro['estado'];
?>

<select class="select" name="estado" id="estado" onchange="cambiarColor()">
    <option id="Pendiente" value="Pendiente" <?php echo ($registro['estado'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
    <option id="Confirmado" value="Confirmado" <?php echo ($registro['estado'] == 'Confirmado') ? 'selected' : ''; ?>>Confirmado</option>
    <option id="Anulado" value="Anulado" <?php echo ($registro['estado'] == 'Anulado') ? 'selected' : ''; ?>>Anulado</option>
</select>


        <input type="hidden" name="DNI" value="<?php echo $registro['DNI']; ?>">

        <input type="submit" class="boton" name="actualizar" value="Modificar">
    </form>
</div>
</div>

<script>
        // Definir una variable JavaScript para almacenar selectedValue
        var selectedValue = "<?php echo $selectedValue; ?>";

        function volver() {
            window.location.href = "paginareservas.php?sec=secciones/reservas.php&vistas=" + selectedValue;
        }

        function mensaje() {
            var mensajeCheck = document.getElementById("mensaje_check");
            var contenedorModificar = document.getElementById("modificar");
            mensajeCheck.style.display = 'block';
            contenedorModificar.style.display = 'none';
        }

    
   



    </script>
   
</body>
</html>
