<?php 
$accion = isset($_SESSION['accion']) ? $_SESSION['accion'] : '';
if (!empty($accion)) {
    echo "<script> alertify.success('$accion'); </script>";
} 
$_SESSION['accion']='';
?>
<div class="miga-de-pan">
    <a href="?c=dashboard">Inicio</a> / <span>Lista de Proveedores</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <a type="submit" href="?c=proveedor&a=Nuevo" class="btn" style="margin-bottom: 30px;"><button class="boton-crear"><i class="fas fa-plus"></i></button></a>
        <div class="division">
            <!-- contenido -->

        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th style="width:20%;">RIF</th>
                    <th style="width:10%;">Logo</th>
                    <th style="width:20%;">Razón Social</th>
                    <th style="width:30%;">Dirección</th>
                    <th style="width:10%;">Teléfono</th>
                    <th style="width:10%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php $contador=1; 
                foreach($this->model->Listar() as $r): ?>
                <tr>
                    <td><?php echo $contador; ?></td>
                    <td><?php echo $r->rif; ?></td>
                    <td><img src="assets/img/proveedores/<?=$r->logo?>" alt="" class="img-tabla"></td>
                    <td><?php echo $r->nombre; ?></td>
                    <td><?php echo $r->direccion; ?></td>
                    <td><?php echo $r->telefono; ?></td>
                    <td>
                        <a style="color: grey; margin-left:10px;" href="?c=proveedor&a=Crud&rif=<?php echo $r->rif; ?>"><i class="fa fa-edit"></i></a>
                
                        <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=proveedor&a=Eliminar&rif=<?php echo $r->rif; ?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php $contador++; 
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

