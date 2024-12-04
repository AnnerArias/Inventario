<?php
require_once 'model/producto.php';
$producto = new producto;

$consulta = $producto->ConsultarStock();

if (!empty($consulta)) {
    echo '<i class="fas fa-bell" style="color:red;"></i>';
    echo '<div class="desplegable">';
    foreach ($consulta as $item) {
        echo '<p>' . $item->nombre . ', está por debajo del mínimo</p>';
    }
    echo '</div>';
}
?>
