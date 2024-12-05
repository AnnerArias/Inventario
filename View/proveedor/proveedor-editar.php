<?php
require_once 'model/categorias.php';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/proveedor">Proveedores</a> / <span>Editando: <?php echo $pvd->nombre; ?></span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
<form id="frm-proveedor" action="http://localhost/Sistemainventario/proveedor/Editar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="rif_anterior" value="<?php echo $pvd->rif; ?>" />
    <input type="hidden" name="imagen_anterior" value="<?php echo $pvd->logo; ?>" />

    <div class="form-group">
        <img src="http://localhost/Sistemainventario/assets/img/proveedores/<?php echo $pvd->logo; ?>" alt="" style="width: 50px;">
        <label class="form_label">Imagen del producto</label>
        <input type="file" name="imagen" class="form_input" />
    </div>
    <div class="form-group">
        <label class="form_label">RIF</label>
        <input type="text" name="rif" value="<?php echo $pvd->rif; ?>" class="form_input" placeholder="Ingrese RIF" data-validacion-tipo="requerido|min:100" data-tooltip="Por favor, ingrese el RIF del proveedor." pattern="[A-Z]-\d{8}-\d" title="Formato: J-88888888-0" />
    </div>
    <div class="form-group">
        <label class="form_label">Razón Social</label>
        <input type="text" name="nombre" value="<?php echo $pvd->nombre; ?>" class="form_input" placeholder="Ingrese Razón Social" data-validacion-tipo="requerido|min:100" data-tooltip="Por favor, ingrese la razón social del proveedor." />
    </div>
    <div class="form-group">
        <label class="form_label">Dirección</label>
        <input type="text" name="direccion" value="<?php echo $pvd->direccion; ?>" class="form_input" placeholder="Ingrese dirección proveedor" data-validacion-tipo="requerido|min:100" data-tooltip="Por favor, ingrese la dirección del proveedor." />
    </div>
    <div class="form-group">
        <label class="form_label">Teléfono</label>
        <input type="tel" name="telefono" value="<?php echo $pvd->telefono; ?>" class="form_input" placeholder="Ingrese teléfono proveedor" data-validacion-tipo="requerido|min:10" data-tooltip="Por favor, ingrese el teléfono del proveedor." />
    </div>
    <div class="text-right" style="margin-top: 15px;">
        <button class="btn btn-success">Actualizar</button>
    </div>
</form>

<script>
    document.getElementById('frm-proveedor').addEventListener('submit', function(event) {
        // Validación de campos
        let valid = true;
        const inputs = document.querySelectorAll('.form_input');
        const telInput = document.querySelector('input[name="telefono"]');
        const rifInput = document.querySelector('input[name="rif"]');

        inputs.forEach(input => {
            if (input.value.trim() === '' && input.name !== 'imagen') {
                valid = false;
                alertify.error('Por favor, complete todos los campos.');
            }
        });        

        if (!/^[A-Z]-\d{8}-\d$/.test(rifInput.value)) {
            valid = false;
            alertify.error('El campo "RIF" debe seguir el formato J-88888888-0.');
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    document.querySelector('input[name="rif"]').addEventListener('input', function() {
        const rifInput = this;
        const rifPattern = /^[A-Z]-\d{8}-\d$/;
        if (!rifPattern.test(rifInput.value)) {
            rifInput.setCustomValidity('El RIF debe seguir el formato J-88888888-0.');
        } else {
            rifInput.setCustomValidity('');
        }
    });
</script>

            <!-- fin del contenido -->
    </div>
</div>