<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Comprobar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST["username"];
    $contrasena = $_POST["password"];

    // Consulta SQL y conexión
    $query = $conn->prepare("SELECT * FROM encargadosreservas WHERE Nombre_de_usuario = ? AND Password = ?");
    $query->bind_param("ss", $username, $contrasena);
    $query->execute();

    // Obtener resultados
    $result = $query->get_result();

    // Comprobar si se encontró un usuario
    if ($result->num_rows == 1) {
        // Usuario autenticado
        $row = $result->fetch_assoc();
        // Obtener otros datos necesarios, como el DNI
        $dni = $row["DNI"];
        
        // Iniciar sesión y almacenar el nombre de usuario y dni en la sesión
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['DNI'] = $dni;

        // Redireccionar a la página de reservas
        header('Location: paginareservas.php');
        exit();
    } else {
        // Usuario no existente
        echo "Usuario no existente";
    }

    // Cerrar la consulta y la conexión
    $query->close();
    $conn->close();
}
?>
