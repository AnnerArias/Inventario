<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/producto">Productos</a> / <span>Editando: <?php echo $prod->nombre; ?> </span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->

            <form id="frm-producto" action="producto/Editar" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $prod->id; ?>" />
                <input type="hidden" name="imagen_anterior" value="<?php echo $prod->imagen; ?>" />

                <div class="form-group">
                    <img src="http://localhost/Sistemainventario/assets/img/productos/<?php echo $prod->imagen; ?>" alt="" style="width: 50px;">
                    <label class="form_label">Imagen del producto</label>
                    <input type="file" name="imagen" id="" class="form_input" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Nombre del producto</label>
                        <input type="text" name="nombre" class="form_input" value="<?php echo $prod->nombre; ?>" placeholder="Ingrese nombre producto" autofocus data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el nombre del producto." />
                    </div>
                    <div class="form-group">
                        <label class="form_label">Presentacion</label>
                        <input type="text" name="presentacion" class="form_input" value="<?php echo $prod->presentacion; ?>" placeholder="Ingrese presentación" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la presentacion o como viene el producto." />
                    </div>
                    <div class="form-group">
                        <label class="form_label">Cantidad por empaque</label>
                        <input type="text" name="cant_empaque" class="form_input" value="<?php echo $prod->cant_empaque; ?>" placeholder="Ingrese cantidad por empaque" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la cantidad por empaque." />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form_label">Categoria</label>
                        <select name="categoria_id" class="form_input"> <?php $cate = $categorias->Obtener($prod->categoria_id);
                                                                        echo '<option value="' . $cate->id . '">' . $cate->nombre . '</option>';
                                                                        foreach ($categorias->Listar() as $r):
                                                                            if ($r->id != $cate->id): ?>
                                    <option value="<?= $r->id ?>"><?= $r->nombre ?></option>
                            <?php
                                                                            endif;
                                                                        endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form_label">Estado del producto</label>
                        <select name="estado" class="form_input">
                            <option value="<?php echo $prod->estado; ?>"><?php echo $prod->estado; ?></option> 
                            <?php 
                                if ($prod->estado == 'Disponible'): 
                            ?> 
                            <option value="Descontinuado">Descontinuado</option> 
                            <?php else: ?> 
                                <option value="Disponible">Disponible</option> 
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form_label">Cantidad mínima en stock</label>
                        <input type="text" name="min_stock" class="form_input" value="<?php echo $prod->min_stock; ?>" placeholder="Ingrese cantidad mínima en stock" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la cantidad mínima en stock." />
                    </div>
                </div>



                <div class="text-right" style="margin-top: 30px;">
                    <button class="btn btn-success">Actualizar</button>
                </div>
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
            <!-- fin de contenido -->
        </div>
    </div>