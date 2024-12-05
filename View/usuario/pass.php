<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/usuario">Usuarios</a> / <span>Actualizar Contraseña</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
            <form id="frm-actualizar-contraseña" action="http://localhost/Sistemainventario/usuario/ActualizarContraseña" method="post" enctype="multipart/form-data" novalidate>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Contraseña Actual</label>
                        <input type="password" name="actual" class="form_input" placeholder="Contraseña Actual" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese su contraseña actual." required />
                        <small class="form-text text-muted">Por favor, ingrese su contraseña actual.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Nueva Contraseña</label>
                        <input type="password" name="nueva" class="form_input" placeholder="Nueva Contraseña" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese su nueva contraseña." required />
                        <small class="form-text text-muted">Por favor, ingrese su nueva contraseña.</small>
                    </div>
                    <div class="form-group">
                        <label class="form_label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="confirmar" class="form_input" placeholder="Confirmar Nueva Contraseña" data-validacion-tipo="requerido" data-tooltip="Por favor, confirme su nueva contraseña." required />
                        <small class="form-text text-muted">Por favor, confirme su nueva contraseña.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <button type="submit" class="btn btn-success" id="btn-actualizar">Actualizar</button>
                    </div>
                </div>
            </form>

            <script>
                document.getElementById('frm-actualizar-contraseña').addEventListener('submit', function(event) {
                    // Validación de campos
                    let valid = true;
                    const actual = document.querySelector('input[name="actual"]').value;
                    const nueva = document.querySelector('input[name="nueva"]').value;
                    const confirmar = document.querySelector('input[name="confirmar"]').value;
                    const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                    if (nueva !== confirmar) {
                        valid = false;
                        alertify.error('Las nuevas contraseñas no coinciden.');
                    }

                    if (!regex.test(nueva)) {
                        valid = false;
                        alertify.error('La nueva contraseña debe tener al menos 8 caracteres, incluir al menos 1 letra mayúscula, 1 número y 1 símbolo.');
                    }

                    if (!valid) {
                        event.preventDefault();
                    }
                });
            </script>

            <!-- fin del contenido -->
        </div>
    </div>
