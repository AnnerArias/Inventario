<?php
$accion = isset($_SESSION['accion']) ? $_SESSION['accion'] : '';
if (!empty($accion)) {
    echo "<script> alertify.success('$accion'); </script>";
}
$_SESSION['accion'] = '';
?>
<div class="miga-de-pan">
    <a href="?c=dashboard">Inicio</a> / <span>Productos en almecen</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
        <table id="tabla" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Disponibilidad</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    $count = 1; 
                    require_once 'model/producto.php';
                    foreach($this->model->Listar() as $r): 
                       
                        $producto = new producto;
                        $prod = $producto->Obtener($r->id);
                     if (isset($prod->id)) {
                    ?>
                    
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $codigo_formateado = 'PROD' . sprintf('%05d', $prod->id); ?></td>
                    <td><img src="assets/img/productos/<?php echo $prod->imagen; ?>" alt="" class="img-tabla"></td>
                    <td><?php echo $prod->nombre; ?></td>
                    <td><?php echo $r->cantidad; ?></td>
                    <!-- <td>
                        <a style="color: grey; margin-left:10px;" href="?c=producto&a=Crud&id=<?php echo $r->id; ?>"><i class="fa fa-edit"></i></a>
                    
                        <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=producto&a=Eliminar&id=<?php echo $r->id; ?>"><i class="fa fa-trash"></i></a>
                    </td> -->
                </tr>
            <?php $count++; 
                        }
        endforeach; ?>
            </tbody>
        </table>
        <!-- fin del contenido -->
    </div>
</div>


