<?php
//-----------------GET estado-------------------------------------
$registro = isset($_SESSION['estado']) ? $_SESSION['estado'] : '';
// Limpiar la variable de sesión después de leerla
unset($_SESSION['estado']);

//-----------------Circulo de estado----------------------------------------------------

function getCircleColor($registro) {
    switch (strtolower(trim($registro))) {
        case 'confirmado':
            return 'green';
        case 'anulado':
            return 'red';
        case 'pendiente':
            return 'yellow';
        default:
            return 'grey';
    }
}

$circleColor = getCircleColor($registro);
?>
<style>
#circle {
    width: 20px; 
    height: 20px; 
    border: 2px solid black; /* Añadido: Borde al círculo para que sea visible */
    border-radius: 50%;
    display: inline-block;
    background-color: <?php echo $circleColor; ?>;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    cambiarColor(); // Asegurar que el color se establece al cargar la página

    function cambiarColor() {
        var estadoSelect = document.getElementById("estado");
        var circle = document.getElementById("circle");

        // Obtener el valor seleccionado
        var selectedColor = estadoSelect.value;

        // Remover todas las clases existentes
        circle.classList.remove("confirmado", "anulado", "pendiente", "default");

        // Agregar la clase correspondiente al estado seleccionado
        if (selectedColor === "Confirmado") {
            circle.classList.add("confirmado");
        } else if (selectedColor === "Anulado") {
            circle.classList.add("anulado");
        } else if (selectedColor === "Pendiente") {
            circle.classList.add("pendiente");
        } else {
            circle.classList.add("default");
        }

        // Actualizar el valor del parámetro en la URL (si es necesario)
        var newUrl = window.location.href.split('?')[0] + '?estado=' + selectedColor;
        window.history.replaceState({ path: newUrl }, '', newUrl);
    }

    // Agregar un evento de cambio a la selección
    document.getElementById("estado").addEventListener("change", cambiarColor);
});
</script>
