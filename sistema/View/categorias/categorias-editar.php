<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="miga-de-pan">
    <a href="?c=dashboard">Inicio</a> / <a href="?c=categorias">Categorias</a> / <span>Editando: <?php echo $cate->nombre; ?> </span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
        <form id="frm-usuario" action="?c=categorias&a=Editar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $cate->id; ?>" />

            <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Nombre</label>
                        <input type="text" autofocus name="nombre" class="form_input" value="<?php echo $cate->nombre; ?>" placeholder="Nombre completo" data-validacion-tipo="requerido" />
                        <small class="form-text text-muted">Por favor, ingrese nombre completo.</small>
                    </div>
            </div>

            <div class="text-right" style="margin-top: 30px;">
                <button class="btn btn-success">Actualizar</button>
            </div>
        </form>
        <script>
            document.getElementById('frm-categorias').addEventListener('submit', function(event) {
                // Validación de campos
                let valid = true;
                const inputs = document.querySelectorAll('.form_input');

                inputs.forEach(input => {
                    if (input.value.trim() === '') {
                        valid = false;
                        alertify.error('Por favor, complete todos los campos.');
                    }
                });

                if (!valid) {
                    event.preventDefault();
                }
            });
        </script>
    </div>
</div>
