<?php 
$accion = isset($_SESSION['accion']) ? $_SESSION['accion'] : '';
if (!empty($accion)) {
    echo "<script> alertify.success('$accion'); </script>";
} 
$_SESSION['accion']='';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <span>Lista de Productos</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <a type="submit" href="producto/Nuevo" class="btn" style="margin-bottom: 30px;"><button class="boton-crear"><i class="fas fa-plus"></i></button></a>
        <div class="division">
            <!-- contenido -->
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;
                    foreach ($this->model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $codigo_formateado = 'PROD' . sprintf('%05d', $r->id); ?></td>
                            <td><img src="http://localhost/Sistemainventario/assets/img/productos/<?php echo $r->imagen; ?>" alt="" class="img-tabla"></td>
                            <td><?php echo $r->nombre; ?></td>
                            <td><?php echo $r->estado; ?></td>
                            <td>
                                <a style="color: grey; margin-left:10px;" href="producto/Crud/<?php echo $r->id; ?>"><i class="fa fa-edit"></i></a>

                                <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="producto/Eliminar/<?php echo $r->id; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php $count++;
                    endforeach; ?>
                </tbody>
            </table>
            <!-- fin del contenido -->
        </div>
    </div>