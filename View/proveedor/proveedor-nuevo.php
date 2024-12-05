<?php
require_once 'model/categorias.php';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/proveedor">Proveedores</a> / <span>Crear nuevo</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->

            <form id="frm-proveedor" action="http://localhost/Sistemainventario/proveedor/Guardar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form_label">RIF</label>
                    <input type="text" name="rif" autofocus class="form_input" placeholder="Ingrese RIF Proveedor" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el RIF del proveedor." />
                </div>
                <div class="form-group">
                    <label class="form_label">Razón Social</label>
                    <input type="text" name="nombre" class="form_input" placeholder="Ingrese Razón Social" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la razón social del proveedor." />
                </div>
                <div class="form-group">
                    <label class="form_label">Teléfono</label>
                    <input type="tel" name="telefono" class="form_input" placeholder="Ingrese teléfono proveedor" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el teléfono del proveedor." />
                </div>
                <div class="form-group">
                    <label class="form_label">Logo del proveedor</label>
                    <input type="file" name="imagen" class="form_input" />
                </div>
                <div class="form-group">
                    <label class="form_label">Dirección</label>
                    <textarea name="direccion" class="form_input" placeholder="Ingrese la dirección del proveedor" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la dirección del proveedor."></textarea>
                </div>
                <div style="margin-top: 30px;">
                    <button class="btn btn-success">Guardar</button>
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