<?php
include_once('conexion.php');
include_once('borrar.php');
// Obtén el ID de la reserva que deseas modificar
$reservaId = isset($_GET['id']) ? $_GET['id'] : null;

// Si tienes un ID válido, incluye el archivo de modificación
if ($reservaId) {
    include_once('borrar.php');
}
// Prepara y ejecuta SELECT
$result = $conn->query('SELECT * FROM reservas');

// Manejo de errores
if ($result === false) {
    die('Error en la consulta: ' . $conn->error);
}
//------Cambio de color del circulo 
include_once('estado_circulo.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/estilo_pagina_principal.css">
    <title>Leer - CRUD PHP</title>
    <style>
        /* La tabla no se ve por defecto */
        .circle {
            width: 10px; 
            height: 10px; 
           
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h2>Listado de Reservas:</h2>
    <div id="vista_general" class='contenedor-tablas'>
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Número de reserva</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Número de personas</th>
                    <th>Número de mesa</th>
                    <th colspan="2">Estado</th>
                    <th>DNI</th>
                    <th>Observaciones</th>
                    <th colspan="2">Acciones</th>
                </tr>
                <?php while ($valor = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $valor['id']; ?></td>
                        <td><?= $valor['nombre_cliente']; ?></td>
                        <td><?= $valor['contacto']; ?></td>
                        <td><?= $valor['fecha_reserva']; ?></td>
                        <td><?= $valor['hora_reserva']; ?></td>
                        <td><?= $valor['num_personas']; ?></td>
                        <td><?= $valor['mesa_id']; ?></td>
                        <td><div class="circle" style="background-color: <?= getCircleColor($valor['estado']); ?>"></div></td>
                        <td><?= $valor['estado']; ?></td>
                       
                        <td><?= $valor['DNI']; ?></td>
                        <td><?= $valor['Observaciones']; ?></td>
                        <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
                        <td><button  class="boton" name="modificar" onclick="abrirPopupModificarReserva(<?= $valor['id']; ?>)">Modificar</button></td>
                        <td><button class="boton" name="botonborrar" class="button" onclick="AbrirBorrar(<?= $valor['id']; ?>)">Borrar</button></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
             <img src="imagenes/icono_pregunta.gif">
            <p>No hay reservas existentes</p>
        <?php endif; ?>
    </div>
</body>

</html>
