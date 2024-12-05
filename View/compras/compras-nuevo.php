<?php
require_once 'model/proveedor.php';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/entradas">Entradas</a> / <span>Crear nueva</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
            <form id="frm-producto" action="http://localhost/Sistemainventario/compras/Guardar" method="post" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group">
            <label class="form_label">Proveedor</label>
            <select name="proveedor_id" class="form_input">
                <?php 
                    $prove = new proveedor;
                    foreach($prove->Listar() as $r): 
                ?>
                <option value="<?=$r->id?>"><?=$r->nombre?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form_label">Fecha</label>
            <input type="date" name="fecha" class="form_input" placeholder="Ingrese nombre producto" autofocus data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la fecha de la factura." />
            <br><small class="form-text text-muted">Por favor, ingrese la fecha de la factura.</small>
        </div>
        <div class="form-group">
            <label class="form_label">Número de factura</label>
            <input type="text" name="factura" class="form_input" placeholder="Ingrese número de factura" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el número de la factura." />
            <br><small class="form-text text-muted">Por favor, ingrese el número de la factura.</small>
        </div>
    </div>
    <div style="margin-top: 30px;">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    document.getElementById('frm-producto').addEventListener('submit', function(event) {
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

        <!-- fin del contenido -->
    </div>
</div>

