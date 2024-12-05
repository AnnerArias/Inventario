<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/usuario">Usuarios</a> / <span>Editando: <?php echo $prod->nombres; ?>, <?php echo $prod->apellidos; ?></span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
        <form id="frm-usuario" action="Sistemainventario/usuario/Editar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $prod->id; ?>" />

            <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Nombres</label>
                        <input type="text" name="nombres" class="form_input" value="<?php echo $prod->nombres; ?>" placeholder="Nombre completo" data-validacion-tipo="requerido" />
                        <small class="form-text text-muted">Por favor, ingrese nombre completo.</small>
                    </div>
                    <div class="form-group">
                        <label class="form_label">Apellidos</label>
                        <input type="text" name="apellidos" class="form_input" value="<?php echo $prod->apellidos; ?>" placeholder="Apellidos completo" data-validacion-tipo="requerido" />
                        <small class="form-text text-muted">Por favor, ingrese nombre completo.</small>
                    </div>
                </div>
                <div class="form-row">    
                    <div class="form-group">
                        <label class="form_label">Correo</label>
                        <input type="text" name="correo" class="form_input" value="<?php echo $prod->correo; ?>" placeholder="Correo" data-validacion-tipo="requerido" />
                        <small class="form-text text-muted">Por favor, ingrese un correo electrónico válido.</small>
                    </div>            
                    <div class="form-group">
                        <label class="form_label">Perfil</label>
                        <select name="rol" class="form_input">
                            <option value="<?php echo $prod->rol; ?>"><?php echo $prod->rol; ?></option>
                            <?php if($_SESSION['user_perfil'] == 'Root') { ?>
                            <option value="Administrador">Administrador</option>
                            <?php } ?>
                            <option value="Operador">Operador</option>
                        </select>
                    </div>
                </div>

            <div class="text-right" style="margin-top: 30px;">
                <button class="btn btn-success">Actualizar</button>
            </div>
        </form>
        <script>
            $(document).ready(function(){
                $("#frm-usuario").submit(function(){
                    return $(this).validate();
                });
            })
        </script>
    </div>
</div>
