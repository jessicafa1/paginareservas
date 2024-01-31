<?php
include_once ('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo_index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>

<style>
input {
    padding: 8px;
    margin-bottom: 16px;
    border: none;
    border-bottom: 1px solid #ccc;
    outline: none;
    border-radius: 10px;
}

    </style>
<body>
    <div class="container">
        <div class="image-container">

     <?php
     include_once('slider_inicio.html');
     ?>
        </div>
        <div class="login-container">
        
 <div id="login">
 <h6>ReservasMesas.com</h6>
            <h2>Login</h2>
 <?php
            // Verificar si se ha enviado el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Incluir el archivo de conexión y autenticación
                include('login.php');
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Nombre de usuario:</label>
    <input  class= "input" type="text" id="username" name="username" >
    <br>
    <label for="password">Contraseña:</label>
    <input  class= "input" type="password" id="password" name="password">
                <br>
                <input type="submit" class="boton" value="Iniciar sesión">
            </form>



</div>
       
        </div>
    </div>
</body>
</html>
