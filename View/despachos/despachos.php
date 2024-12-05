<?php
$accion = isset($_SESSION['accion']) ? $_SESSION['accion'] : '';
if (!empty($accion)) {
    echo "<script> alertify.success('$accion'); </script>";
}
$_SESSION['accion'] = '';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <span>Lista de Salidas</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <a type="submit" href="salidas/Nuevo" class="btn" style="margin-bottom: 30px;"><button class="boton-crear"><i class="fas fa-plus"></i></button></a>
        <div class="division">
            <!-- contenido -->
        <table id="tabla" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Factura número</th>
                    <th>fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                require_once 'model/usuario.php';
                
                $count = 1; 
                foreach($this->model->Listar() as $r): 
                $usuario = new usuario();
                $usuario = $usuario->Obtener($r->emisor_id);
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $usuario->nombres; ?></td>
                    <td><?php echo $r->factura; ?></td>
                    <td><?php echo $r->fecha; ?></td>
                    <td>
                        <a style="color: grey; margin-left:10px;" href="salidas/Detalles/<?php echo $r->id; ?>"><i class="fa fa-edit"></i></a>
                    
                        <!-- <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="despachos/Eliminar&id=<?php echo $r->id; ?>"><i class="fa fa-trash"></i></a> -->
                    </td>
                </tr>
            <?php $count++; endforeach; ?>
            </tbody>
        </table>
        <!-- fin del contenido -->
    </div>
</div>


