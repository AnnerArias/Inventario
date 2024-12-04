<<?php
require_once 'model/categorias.php';
$categorias = new categorias;
?>
<div class="contenedor"> 
        <ul class="miga-de-pan">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="?c=producto">Productos</a></li>
            <li>Actualizando - <?php echo $prod->nombre; ?></li> 
        </ul>
        <form id="frm-producto" action="?c=producto&a=Editar" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $prod->id; ?>" />
                <input type="hidden" name="imagen_anterior" value="<?php echo $prod->imagen; ?>" />

                <div class="form-group">
                    <img src="assets/img/productos/<?php echo $prod->imagen; ?>" alt="" style="width: 50px;">
                    <label class="form_label">Imagen del producto</label>
                    <input type="file" name="imagen" id="" class="form_input"/>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form_label">Nombre del producto</label>
                    <input type="text" name="nombre" class="form_input" value="<?php echo $prod->nombre; ?>" placeholder="Ingrese nombre producto" autofocus data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese el nombre del producto.</small>
                </div>
                <div class="form-group">
                    <label class="form_label">Presentacion</label>
                    <input type="text" name="presentacion" class="form_input" value="<?php echo $prod->presentacion; ?>" placeholder="Ingrese presentación" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la presentacion o como viene el producto.</small>
                </div>
                <div class="form-group">
                    <label class="form_label">Cantidad por empaque</label>
                    <input type="text" name="cant_empaque" class="form_input" value="<?php echo $prod->cant_empaque; ?>" placeholder="Ingrese cantidad por empaque" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la cantidad por empaque.</small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form_label">Categoria</label>
                    <select name="categoria_id" class="form_input">
                    <?php
                        $cate = $categorias->Obtener($prod->categoria_id);
                        echo'<option value="'.$cate->id.'">Actual: '.$cate->nombre.'</option>';
                        foreach($categorias->Listar() as $r):
                    ?>
                        <option value="<?=$r->id?>"><?=$r->nombre?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form_label">Estado del producto</label>
                    <select name="estado" class="form_input">
                        <option value="<?php echo $prod->estado; ?>">Actual: <?php echo $prod->estado; ?></option>
                        <option value="Disponible">Disponible</option>
                        <option value="Descontinuado">Descontinuado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form_label">Cantidad mínima en stock</label>
                    <input type="text" name="min_stock" class="form_input" value="<?php echo $prod->min_stock; ?>" placeholder="Ingrese cantidad mínima en stock" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la cantidad mínima en stock.</small>
                </div>
            </div>

                

                <div class="text-right" style="margin-top: 30px;">
                    <button class="btn btn-success">Actualizar</button>
                </div>
        </form>
        <script>
            $(document).ready(function(){
                $("#frm-producto").submit(function(){
                    return $(this).validate();
                });
            })
        </script>
</div>