<?php
$accion = isset($_SESSION['accion']) ? $_SESSION['accion'] : '';
if (!empty($accion)) {
    echo "<script> alertify.success('$accion'); </script>";
}
$_SESSION['accion'] = '';
?>
<div class="miga-de-pan">
    <a href="?c=dashboard">Inicio</a> / <span>Lista de Usuarios</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <a type="submit" href="?c=usuario&a=Nuevo" class="btn" style="margin-bottom: 30px;"><button class="boton-crear"><i class="fas fa-plus"></i></button></a>
        <div class="division">
            <!-- contenido -->
        <table id="tabla" class="display">
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th style="width:30%;">Nombres y Apellidos</th>
                    <th style="width:30%;">Correo</th>
                    <th style="width:10%;">Perfil</th>
                    <th style="width:10%;">Estado</th>
                    <th style="width:15%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->Listar() as $r): ?>
                    <tr>
                        <td><?php echo $r->id; ?></td>
                        <td><?php echo $r->nombres.', '.$r->apellidos; ?></td>
                        <td><?php echo $r->correo; ?></td>
                        <td><?php echo $r->rol; ?></td>
                        <td><?php echo $r->estado; ?></td>
                        <td>
                            <a style="color: grey; margin-left:10px;" href="?c=usuario&a=Crud&id=<?php echo $r->id; ?>"><i class="fa fa-edit"></i></a>
                        
                            <a style="<?php if($r->estado == 'Activo'){ echo 'color: red;';}else{ echo 'color: green;';} ?> margin-left:10px;" onclick="javascript:return confirm('¿Cambiar es estado del usuario?');" href="?c=usuario&a=Eliminar&id=<?php echo $r->id; ?>"><i class="fa fa-toggle-on"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- fin del contenido -->
</div>