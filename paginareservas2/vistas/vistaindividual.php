

<?php
include_once('conexion.php');//si pongo conexion.php da error siendo exactamente lo mismo
include_once('borrar.php');
$reservaId = isset($_GET['id']) ? $_GET['id'] : null;


// Si tienes un ID válido, incluye el archivo de modificación
if ($reservaId) {
    include_once('borrar.php');
}
$consulta=$conn;
$datos_reserva = $consulta->query("SELECT * FROM reservas");
echo " <h2>Listado de Reservas:</h2>";
if ($datos_reserva) {
        $num_reservas = $datos_reserva->num_rows;

        if ($num_reservas > 0) {
            echo "<div>
                   ";

            echo "<div   id='vista_individual' class='contenedor-tablas'>";

            while ($row = $datos_reserva->fetch_assoc()) {
                $tablaId = 'tabla_' . $row['id'];


                $estadoTemporalId = 'estado_temporal_' . $row['id'];
                echo "<div> 
                <button height='2px' id='boton1' onclick='toggleAcciones(" . $row['id'] . ")' >...</button>
    
            <div id='acciones" . $row['id'] . "' style='display:none'>
          <button class='boton' name='modificar' onclick='abrirPopupModificarReserva(" . $row['id'] . ")'>Modificar</button>
          <button class='boton' name='botonborrar' class='button' onclick='AbrirBorrar(" . $row['id'] . ")'>Borrar</button>
      </div>
              
                     
                          
                        <form method='POST' action='paginareservas.php?sec=reservas.php' id='form_{$tablaId}'>
                            <table  class='{$tablaId}'>
                                <tr>
                                    <th>Id</th>
                                    <td>{$row['id']}</td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <td>
                                        <p class='{$tablaId}_nombre'>{$row['nombre_cliente']}</p>
                                       
                                    </td>
                                </tr>
                                <th>Número de contacto</th>
                                <td>{$row['contacto']}</td>
                                </tr>
                                <tr>
                                    <th>Fecha </th>
                                    <td>{$row['fecha_reserva']}</td>
                                </tr>
                                <tr>
                                    <th>Hora</th>
                                    <td>{$row['hora_reserva']}</td>
                                </tr>
                                <tr>
                                    <th>Numero de personas</th>
                                    <td>{$row['num_personas']}</td>
                                </tr>
                                <tr>
                                    <th>Numero de mesa</th>
                                    <td>{$row['mesa_id']}</td>
                                </tr>
                                <tr>
                                    <th>Observaciones</th>
                                    <td>{$row['Observaciones']}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <p class='estado'>{$row['estado']}</p>
                                       
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' id='{$estadoTemporalId}' name='estado_temporal[{$row['id']}]' value=''>
                        </form>
                    </div>";
            }
            echo "</div></div>";
        } else {
            echo "  <img src='imagenes/icono_pregunta.gif'>";
            echo "No hay reservas existentes.";
        }
        $consulta->close();

    }
    echo "</div>"
    ?>
<script>
    function toggleAcciones(id) {  
        var acciones = document.getElementById('acciones' + id);
        if (acciones.style.display === 'block') {
            acciones.style.display = 'none';
        } else {
            acciones.style.display = 'block';
        }
    }

    function toggleAcciones2(id) {  
        var acciones = document.getElementById('acciones');
        if (acciones.style.display === 'none' || acciones.style.display === '') {
            acciones.style.display = 'block';
        } else {
            acciones.style.display = 'none';
        }
    }
</script>

