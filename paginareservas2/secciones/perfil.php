<?php
// Incluir el archivo de conexión a la base de datos
include_once('conexion.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redirigir al inicio de sesión
    header('Location: paginareservas.php');
    exit();
}
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redirigir al inicio de sesión
    header('Location: index.php');
    exit();
}

// Obtener el nombre de usuario desde la sesión
$username = $_SESSION['username'];
// Obtener dni
$dni = isset($_SESSION['DNI']);
// Consulta SQL y conexión con sentencia preparada
$query = $conn->prepare("SELECT * FROM encargadosreservas WHERE Nombre_de_usuario = ?");
$query->bind_param("s", $username);
$query->execute();

// Obtener resultados
$result = $query->get_result();

// Comprobar si se encontró un usuario
if ($result->num_rows == 1) {
    // Usuario encontrado, obtener información del usuario
    $row = $result->fetch_assoc();
    $dni = $row['DNI'];
    $nombre = $row['Nombre'];
    $apellido = $row['Apellido'];
    $rol = $row['Rol'];
} else {
    // Usuario no encontrado
    echo "Error al obtener la información del usuario";
    exit();
}

// Cerrar la consulta
$query->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/estilo_perfil2.css">

    <title>Perfil de Usuario</title>
</head>
<body>
    <div id="contenedor_usuario" class="contenedor">
        <!-- Contenido foto y botones de navegación -->
        <div id="contenedor_perfil">
            <div id="foto">
                <div id="foto_perfil">
            
                    <button id="subir_foto" onclick="#"></button>
        
                </div>
            </div>
        </div>
        
        <!-- Contenido -->
        <div id="contenido_perfil">
            <h3><?php echo $username; ?></h3>
           
            <span style="color: #b36f32;"><?php echo $rol; ?></span>
            <ul class="lista_perfil">
                <li>Nombre: <?php echo $nombre; ?></li>
                <li>Apellido: <?php echo $apellido; ?></li>
                <li>DNI: <?php echo $dni; ?></li>
            </ul>
          
            <p><button class="boton" onclick="#">Editar</button></p>
        </div>
        
        <!-- Limpiar el float para evitar problemas de diseño -->
        <div class="clear"></div>
    </div>

    <h3 class="titulo">Mi equipo</h3>
    <div id="contenedor_equipo">
        <div class="relleno">
            <div id="equipo">
                <div class="miembro">
                    <img src="imagenes/perfil1.png">
                    <div class="miembro-info">
                        <h4>Christina</h4>
                        <hr>
                        <p class="destacado">Camarera</p>
                        <p>Duis leo. Donec sodales sagittis Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editarPerfil(dni) {
            window.location.href = 'paginareservas.php?sec=editar.php&DNI=' + dni;
        };

        function redirigir(){
            window.location.href = 'paginareservas.php?sec=secciones/reservas.php';

        }
    </script>
</body>

</html>





