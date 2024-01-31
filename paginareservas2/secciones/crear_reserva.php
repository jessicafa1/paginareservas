<?php



// Incluir el archivo de conexión a la base de datos
include_once('conexion.php');
// Recuperar el DNI 
$dni = isset($_SESSION['DNI']);
// Recuperar el DNI de la sesión para el formulario
$dni = isset($_SESSION['DNI']) ? $_SESSION['DNI'] : '';
// Verificar si el usuario ha iniciado sesión


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo-formulario_crear_reserva.css">

    <!-- Puedes incluir aquí las etiquetas meta, enlaces a estilos, etc. -->
</head>
<style>
       
    </style>
<body>
    <div id="formularioCrearReserva">
        <h2>Crear Reserva</h2>
        <form id="formulario" action="procesar_reserva.php" method="post">
            <label for="nombre">Nombre del Cliente:</label>
            <input type="text" name="nombre" required>

            <label for="contacto">Contacto:</label>
            <input type="text" name="contacto" required>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" required>

            <label for="num_personas">Número de personas:</label>
            <input type="number" name="num_personas" required>

            <label for="num_mesa">Número de mesa:</label>
            <input type="number" name="num_mesa" required>

            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" required></textarea>

            <input type="hidden" name="DNI" required value="<?php echo $dni; ?>">

            <input type="submit" class="boton" value="Crear Reserva">
        </form>
    </div>
</body>

</html>
