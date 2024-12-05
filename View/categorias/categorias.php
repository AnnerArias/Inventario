<?php
$accion = isset($_SESSION['accion']) ? $_SESSION['accion'] : '';
if (!empty($accion)) {
    echo "<script> alertify.success('$accion'); </script>";
}
$_SESSION['accion'] = '';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <span>Lista de Categorias</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <a type="submit" href="categorias/Nuevo" class="btn" style="margin-bottom: 30px;"><button class="boton-crear"><i class="fas fa-plus"></i></button></a>
        <div class="division">
            <!-- contenido -->
            <table id="tabla" class="display">
                <thead>
                    <tr>
                        <th style="width:5%;">#</th>
                        <th style="width:60%;">Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->id; ?></td>
                            <td><?php echo $r->nombre; ?></td>
                            <td>
                                <a style="color: grey; margin-left:10px;" href="categorias/Crud/<?php echo $r->id; ?>"><i class="fa fa-edit"></i></a>

                                <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Eliminar esta categoria?');" href="categorias/Eliminar/<?php echo $r->id; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- fin del contenido -->
        </div>
    </div>