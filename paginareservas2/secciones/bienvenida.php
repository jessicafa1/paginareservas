<?php
        // Obtener el nombre de usuario de la sesión
        $nombreUsuario = $_SESSION['username'];
    ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo_bienvenida.css">
    <title>Bienvenido a Reservas Mesas</title>
</head>
<body>
    <div class="contenedor">
  

 
   </div>

    <div class="contenedor-texto">
        <h2>Bienvenido, <?php echo $nombreUsuario; ?>, a Reservas Mesas</h2>
        
        <p>¡Nos complace darte la bienvenida a ReservasMesas, tu plataforma dedicada a hacer que tus reservas sean más fáciles y personalizadas que nunca!</p>

        <h3>¿Cómo Funciona?</h3>

        <p>En ReservasMesas, te ofrecemos la posibilidad de gestionar tus reservas de una manera sencilla y eficiente. Aquí tienes una breve guía sobre cómo aprovechar al máximo nuestra plataforma:</p>

        <ul>
            <li><b>Hacer Reservas:</b>
                <ul>
                    <li>Navega a través de nuestro intuitivo sistema para realizar tus reservas de mesas de manera rápida y fácil.</li>
                    <li>Selecciona la fecha, hora y número de comensales para personalizar tu experiencia.</li>
                </ul>
            </li>

            <li><b>Registro Detallado:</b>
                <ul>
                    <li>Mantén un registro detallado de tus reservas anteriores y futuras para un mejor seguimiento.</li>
                    <li>Accede a información clave, como fechas, detalles de la reserva y preferencias específicas.</li>
                </ul>
            </li>

            <li><b>Diseños Personalizados:</b>
                <ul>
                    <li>Personaliza la disposición de tus mesas según tus preferencias y necesidades.</li>
                    <li>Visualiza el diseño antes de confirmar la reserva para garantizar una experiencia perfecta.</li>
                </ul>
            </li>

            <li><b>Calendario Integrado:</b>
                <ul>
                    <li>Consulta nuestro calendario integrado para verificar la disponibilidad de fechas y horas.</li>
                    <li>Planifica tus reservas de manera eficiente y evita conflictos de programación.</li>
                </ul>
            </li>

            <li><b>Funciones Mejoradas:</b>
                <ul>
                    <li>Estamos constantemente trabajando en mejorar tu experiencia.</li>
                    <li>Pronto podrás disfrutar de nuevas funciones diseñadas para hacer que la gestión de reservas sea aún más cómoda y personalizada.</li>
                </ul>
            </li>
        </ul>

        <p>¡En ReservasMesas, nuestro objetivo es brindarte una experiencia de reserva sin complicaciones y adaptada a tus necesidades! Explora nuestras funciones y no dudes en ponerte en contacto con nosotros si necesitas ayuda o tienes sugerencias para hacer que tu experiencia sea aún mejor.</p>

        <p>¡Gracias por elegir ReservasMesas para tus reservas de mesas! Esperamos que disfrutes de cada momento con nosotros.</p>

        <p>¡Bienvenido y que tengas una experiencia increíble!</p>
    </div>
</div>
</body>
</html>
