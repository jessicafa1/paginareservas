<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservasmesas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    // Enviar mensaje a la consola del navegador
    echo "<script>console.log('Conexión exitosa');</script>";
}

// Aquí puedes realizar operaciones con la base de datos

?>