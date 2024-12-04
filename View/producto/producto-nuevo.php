<?php
require_once 'model/categorias.php';
?>
<div class="miga-de-pan">
    <a href="?c=dashboard">Inicio</a> / <a href="?c=producto">Productos</a> / <span>Crear nuevo</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->

            <form id="frm-producto" action="?c=producto&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="form-group"> <label class="form_label">Imagen del producto</label> <input type="file" name="imagen" id="" class="form_input" /> </div>
                <div class="form-group"> <label class="form_label">Nombre del producto</label> <input type="text" name="nombre" class="form_input" placeholder="Ingrese nombre producto" autofocus data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el nombre del producto." /> </div>
                <div class="form-group"> <label class="form_label">Presentacion</label> <input type="text" name="presentacion" class="form_input" placeholder="Ingrese presentación" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la presentacion o como viene el producto." /> </div>
                <div class="form-group"> <label class="form_label">Cantidad por empaque</label> <input type="number" name="cant_empaque" class="form_input" placeholder="Ingrese cantidad por empaque" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la cantidad por empaque." /> </div>
                <div class="form-group"> <label class="form_label">Categoria</label> <select name="categoria_id" class="form_input">
                        <?php $categorias = new categorias;
                        foreach ($categorias->Listar() as $r): ?> <option value="<?= $r->id ?>"><?= $r->nombre ?></option> <?php endforeach ?> </select> </div>
                <div class="form-group"> <label class="form_label">Estado del producto</label> <select name="estado" class="form_input">
                        <option value="Disponible">Disponible</option>
                        <option value="Descontinuado">Descontinuado</option>
                    </select> </div>
                <div class="form-group"> <label class="form_label">Cantidad mínima en stock</label> <input type="number" name="min_stock" class="form_input" placeholder="Ingrese cantidad mínima en stock" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la cantidad mínima en stock." /> </div>
                <div style="margin-top: 30px;"> <button class="btn btn-success">Guardar</button> </div>
            </form>
            <script>
                document.getElementById('frm-producto').addEventListener('submit', function(event) {
                    // Validación de campos
                    let valid = true;
                    const inputs = document.querySelectorAll('.form_input');
                    const numberInputs = document.querySelectorAll('input[name="cant_empaque"], input[name="min_stock"]');

                    inputs.forEach(input => {
                        if (input.value.trim() === '' && input.name !== 'imagen') {
                            valid = false;
                            alertify.error('Por favor, complete todos los campos.');
                        }
                    });

                    numberInputs.forEach(input => {
                        if (!/^\d+$/.test(input.value)) {
                            valid = false;
                            alertify.error('Los campos "Cantidad por empaque" y "Cantidad mínima en stock" solo deben contener números.');
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