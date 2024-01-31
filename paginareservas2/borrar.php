<?php
include_once('conexion.php');


$reservaId = isset($_GET['id']) ? $_GET['id'] : null;
$selectedValue = isset($_GET['vistas']) ? $_GET['vistas'] : null;
$vistas = isset($_GET['vistas']) ? $_GET['vistas'] : "vistas/vistageneral.php";
// Si tienes un ID válido, incluye el archivo de modificación
if ($reservaId) {
    include_once('borrar.php');}


//----------------------------- Rescogida de datos-----------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['respuesta_si']) && $reservaId !== null) {
        // Obtén el ID de la reserva que deseas borrar

        // Asignar la conexión a $miPDO
        $respuesta_borrar = $conn;

        // Realizar la consulta para eliminar la fila específica
        $consulta = $respuesta_borrar->prepare("DELETE FROM reservas WHERE id = ?");
        $consulta->bind_param('i', $reservaId);
        $consulta->execute();
//---------------------------Mensaje de confirmación--------------------------------
        if ($consulta) {
            $_SESSION['eliminar_exito'] = '¡Su reserva ha sido eliminada con éxito!';
 
            header('Location: paginareservas.php?sec=secciones/reservas.php&vistas=' . $selectedValue);//redirección a la pagina deceadeada

            exit();
        } else {
            echo "Error al intentar eliminar la fila.";
        }
    } elseif (isset($_POST['respuesta_no'])) {
        header('Location: paginareservas.php?sec=secciones/reservas.php&vistas=' . $selectedValue);//redirección a la pagina deceadeada
        exit();
    }
}

//-------------------------------------------------------------------------------------------------
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
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #popup2 p {
            margin: 0 0 15px;
        }

        #popup2 button {
          
            padding: 10px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display:inline-block; 
            float:right;
        }

        #popup2 button:hover {
            background-color: #d57500;
            color: #fff;
        }
    </style>
</head>
<body>

<!----------------------------------Mesaje confirmación borrado ----------------------------------------->
    <div id="popup2-overlay">
        <div id="popup2">
            <?php if ($selectedValue) : ?>
             
            <?php endif; ?>
            <p>¿Estás seguro de que quieres borrar la fila con ID <?php echo $reservaId; ?>?</p>
            <form method="POST" action="">
                <button type="submit" name="respuesta_si">Sí</button>
            </form>
            <button type="button" name="respuesta_no" onclick="cerrarPopup()">No</button>
        </div>
    </div>
 
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
