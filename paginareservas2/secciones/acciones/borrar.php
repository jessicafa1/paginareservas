<?php
include_once('conexion.php');


$reservaId = isset($_GET['id']) ? $_GET['id'] : null;
$selectedValue = isset($_GET['vistas']) ? $_GET['vistas'] : null;

// Si tienes un ID válido, incluye el archivo de modificación
if ($reservaId) {
    include_once('borrar.php');}


// Rescogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['respuesta_si']) && $reservaId !== null) {
        // Obtén el ID de la reserva que deseas borrar

        // Asignar la conexión a $miPDO
        $respuesta_borrar = $conn;

        // Realizar la consulta para eliminar la fila específica
        $consulta = $respuesta_borrar->prepare("DELETE FROM reservas WHERE id = ?");
        $consulta->bind_param('i', $reservaId);
        $consulta->execute();

        if ($consulta) {
            echo "¡Reserva número=" . $reservaId . " eliminada con éxito!";
            header('Location: paginareservas.php?sec=reservas.php&vistas=' . $selectedValue);//redirección a la pagina deceadeada

            exit();
        } else {
            echo "Error al intentar eliminar la fila.";
        }
    } elseif (isset($_POST['respuesta_no'])) {
        header('Location: paginareservas.php?sec=reservas.php&vistas=' . $selectedValue);//redirección a la pagina deceadeada
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Borrado</title>
    <style>
        #popup2-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        #popup2 {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <!-- Tu código actual -->

    <div id="popup2-overlay">
        <div id="popup2">
            <?php if ($selectedValue) : ?>
                <p>Vista Seleccionada: <?php echo $selectedValue; ?></p>
            <?php endif; ?>
            <p>¿Estás seguro de que quieres borrar la fila con ID <?php echo $reservaId; ?>?</p>
            <form method="POST" action="">
                <button type="submit" name="respuesta_si">Sí</button>
            </form>
            <button type="button" name="respuesta_no" onclick="cerrarPopup()">No</button>
        </div>
    </div>
    <!-- Fin de tu código actual -->

    <script>
         function cerrarPopup() {
            var popupOverlay = document.getElementById('popup2-overlay');
            var popup = document.getElementById('popup2');
            popupOverlay.style.display = 'none';
            popup.style.display = 'none';
        }
    </script>
</body>
</html>
