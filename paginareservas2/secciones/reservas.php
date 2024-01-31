<?php

include_once('conexion.php');
include_once ('borrar.php');

//---------GET reserva ID----------------------------
$reservaId = isset($_GET['id']) ? $_GET['id'] : null;
if ($reservaId) {
    include_once('borrar.php');
}

// Asignar la conexión a $consulta
$consulta = $conn;
if ($consulta->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}


//-------------------- Define $vistas------------------------------------------------------
$selectedValue = isset($_GET['vistas']) ? $_GET['vistas'] : null;
$vistas = isset($_GET['vistas']) ? $_GET['vistas'] : "vistas/vistageneral.php";


//-----------------GET Mensaje Modificado con éxito-------------------------------------
$mensajeExito = isset($_SESSION['mensaje_exito']) ? $_SESSION['mensaje_exito'] : '';
// Limpiar la variable de sesión después de leerla
unset($_SESSION['mensaje_exito']);

//-----------------GET Mensaje Eliminado con éxito-------------------------------------
$mensajeExitoEliminar = isset($_SESSION['eliminar_exito']) ? $_SESSION['eliminar_exito'] : '';
// Limpiar la variable de sesión después de leerla
unset($_SESSION['eliminar_exito']);

//------Cambio de color del circulo 
include_once('estado_circulo.php');

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo_pagina_principal.css">



    <script>
         
        function actualizarVista() {
            var select = document.getElementById("vista");
            var selectedValue = select.options[select.selectedIndex].value;
            window.location.href = "paginareservas.php?sec=secciones/reservas.php&vistas=" + selectedValue;
        }
        function abrirPopupModificarReserva(reservaId) {
            var select = document.getElementById("vista");
    var selectedValue = select.options[select.selectedIndex].value;


    window.location.href = 'paginareservas.php?sec=modificar.php&vistas=' + selectedValue + '&id=' + reservaId;
           
        }

        function AbrirBorrar(reservaId) {
    // Obtener el valor seleccionado
    var select = document.getElementById("vista");
    var selectedValue = select.options[select.selectedIndex].value;

    // Configurar localStorage con el ID de la reserva y el valor seleccionado
    localStorage.setItem('reservaId', reservaId);
    localStorage.setItem('selectedValue', selectedValue);

    // Redirigir a la página con el ID y el valor en la URL
    window.location.href = 'paginareservas.php?sec=secciones/reservas.php&vistas=' + selectedValue + '&id=' + reservaId;
}

document.addEventListener("DOMContentLoaded", function() {
    // Verificar si hay un ID de reserva en localStorage
    var storedReservaId = localStorage.getItem('reservaId');
    var storedSelectedValue = localStorage.getItem('selectedValue');

    if (storedReservaId && storedSelectedValue) {
        // Mostrar el popup según sea necesario
        var popupOverlay = document.getElementById("popup2-overlay");
        var popup = document.getElementById("popup2");
        popupOverlay.style.display = 'block';
        popup.style.display = 'block';

        // Limpiar el ID de reserva almacenado
        localStorage.removeItem('reservaId');
        localStorage.removeItem('selectedValue');
    }
});

</script>



    <title>Crear reserva</title>

    <script>
        // Función para cerrar el mensaje después de 5 segundos
        function cerrarMensaje() {
            var mensaje = document.getElementById("mensaje_check");
            mensaje.style.display = 'none';
        }

        // Esperar 5 segundos y luego cerrar el mensaje
        setTimeout(cerrarMensaje, 2000);
    </script>
</head>

<body>
<!--- Mensaje de confirmacion por la modificación --->
<div id="contenedor_modificar">
        <div id="modificar" style="display:block">
              <?php
   
        if ($mensajeExito) {
            echo "<div id='mensaje_check'>
                    <img src='imagenes/check.gif' alt='Check GIF'>
                    <p>¡Su reserva ha sido modificada con éxito!</p>
                  </div>";
        }
        ?>

        </div>
     <!--- Mensaje de confirmacion por la eliminación --->     

     <div id="contenedor_eliminar">
        <div id="eliminar" style="display:block">
         
            <?php
        // Muestra el mensaje si es "exitoso"
        if ($mensajeExitoEliminar) {
            echo "<div id='mensaje_check'>
                    <img src='imagenes/basura.png' alt='Check GIF'>
                    <p>¡Su reserva ha sido eliminada con éxito!</p>
                  </div>";
        }
        ?>

        </div>
    </div>

    <div id="vistas">
    <button  class="boton" name="botonCrearReserva" onclick="crearReserva()">Crear reserva</button>
    <select  class="boton" id="vista" onchange="actualizarVista()">
        <option value="vistas/vistaindividual.php" <?php echo ($vistas === 'vistas/vistaindividual.php' ? 'selected' : ''); ?>>Vista individual</option>
        <option value="vistas/vistageneral.php" <?php echo ($vistas === 'vistas/vistageneral.php' ? 'selected' : ''); ?>>Vista general</option>
    </select>
        <?php include_once $vistas; 
        
        
        ?>


    </div><br><br>


        <script>
        function crearReserva() {
            window.location.href = 'paginareservas.php?sec=secciones/crear_reserva.php';
        };

    </script>


</body>

</html>
