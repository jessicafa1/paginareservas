
<?php
include_once('conexion.php');
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redirigir al inicio de sesión
    header('Location: index.php');
    exit();
}


// Si tienes un ID válido, incluye el archivo de modificación


$seccion = isset($_GET['sec']) ? $_GET['sec'] : "secciones/bienvenida.php"; // Uso de operador ternario
 

 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Reservas</title>

    <link rel="stylesheet" href="estilos/estilo_pagina_principal.css">
    <link rel="stylesheet" href="estilos/estilo_menu_lateral.css">
    <link rel="stylesheet" href="estilos/estilo_menu_cabecera.css">
</head>

<body>

    <div id="container">



        <div id="lateral-izquierdo">
       
            <img width="190px" src="imagenes/logo.png" alt="logo">
          
   
            <?php include "menu_lateral.php"; ?><br>
           
        </div>

        <div id="contenido">
            <?php include "$seccion"; ?>
        </div>
       
    </div>

</body>

</html>
