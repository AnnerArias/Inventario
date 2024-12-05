<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/categorias">Categorias</a> / <span>Crear nuevo</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
        <form id="frm-categorias" action="categorias/Guardar" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form_label">Nombre</label>
                <input type="text" autofocus autocomplete="off" name="nombre" class="form_input" placeholder="Nombre completo" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese nombre de la categoria." />
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <input type="submit" class="btn btn-success" id="btn-guardar" value="Guardar">
                </div>
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