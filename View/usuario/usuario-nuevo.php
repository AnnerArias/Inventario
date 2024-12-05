<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/usuario">Usuarios</a> / <span>Crear nuevo</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
            <form id="frm-usuario" action="http://localhost/Sistemainventario/usuario/Guardar" method="post" enctype="multipart/form-data" novalidate>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Nombres</label>
                        <input type="text" name="nombres" class="form_input" placeholder="Nombre completo" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese nombre completo." />
                        <small class="form-text text-muted">Por favor, ingrese nombre completo.</small>
                    </div>
                    <div class="form-group">
                        <label class="form_label">Apellidos</label>
                        <input type="text" name="apellidos" class="form_input" placeholder="Apellidos completo" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese apellido completo." />
                        <small class="form-text text-muted">Por favor, ingrese apellido completo.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Correo</label>
                        <input type="email" name="correo" class="form_input" placeholder="Correo" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese un correo electrónico válido." />
                        <small class="form-text text-muted">Por favor, ingrese un correo electrónico válido.</small>
                    </div>
                    <div class="form-group">
                        <label class="form_label">Perfil</label>
                        <select name="rol" class="form_input">
                            <?php if ($_SESSION['user_perfil'] == 'Root') { ?>
                                <option value="Administrador">Administrador</option>
                            <?php } ?>
                            <option value="Operador">Operador</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="estado" value="Activo">
                <div class="form-row">
                    <div class="form-group full-width">
                        <button type="submit" class="btn btn-success" id="btn-guardar">Guardar</button>
                    </div>
                </div>
            </form>

            <script>
                document.getElementById('frm-usuario').addEventListener('submit', function(event) {
                    // Validación de campos
                    let valid = true;
                    const inputs = document.querySelectorAll('.form_input');
                    const emailInput = document.querySelector('input[name="correo"]');

                    inputs.forEach(input => {
                        if (input.value.trim() === '') {
                            valid = false;
                            alertify.error('Por favor, complete todos los campos.');
                        }
                    });

                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(emailInput.value)) {
                        valid = false;
                        alertify.error('Por favor, ingrese un correo electrónico válido.');
                    }

                    if (!valid) {
                        event.preventDefault();
                    }
                });
            </script>

            <!-- fin del contenido -->
        </div>
    </div>