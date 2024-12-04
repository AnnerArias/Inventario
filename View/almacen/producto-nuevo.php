<<?php
require_once 'model/categorias.php';
?>
<div class="container_tabla">
    <div class="contenedor"> 
        <ul class="miga-de-pan">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="?c=producto">Productos</a></li>
            <li>Nuevo producto</li> 
        </ul>
        <form id="frm-producto" action="?c=producto&a=Guardar" method="post" enctype="multipart/form-data">
            <div class="form-group">
                    <label class="form_label">Imagen del producto</label>
                    <input type="file" name="imagen" id="" class="form_input"/>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form_label">Nombre del producto</label>
                    <input type="text" name="nombre" class="form_input" placeholder="Ingrese nombre producto" autofocus data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese el nombre del producto.</small>
                </div>
                <div class="form-group">
                    <label class="form_label">Presentacion</label>
                    <input type="text" name="presentacion" class="form_input" placeholder="Ingrese presentación" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la presentacion o como viene el producto.</small>
                </div>
                <div class="form-group">
                    <label class="form_label">Cantidad por empaque</label>
                    <input type="text" name="cant_empaque" class="form_input" placeholder="Ingrese cantidad por empaque" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la cantidad por empaque.</small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form_label">Categoria</label>
                    <select name="categoria_id" class="form_input">
                    <?php 
                        $categorias = new categorias;
                        foreach($categorias->Listar() as $r): 
                    ?>
                    <option value="<?=$r->id?>"><?=$r->nombre?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form_label">Estado del producto</label>
                    <select name="estado" class="form_input">
                        <option value="Disponible">Disponible</option>
                        <option value="Descontinuado">Descontinuado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form_label">Cantidad mínima en stock</label>
                    <input type="text" name="min_stock" class="form_input" placeholder="Ingrese cantidad mínima en stock" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la cantidad mínima en stock.</small>
                </div>
            </div>
            
                <div style="margin-top: 30px;">
                    <button class="btn btn-success">Guardar</button>
                </div>
        </form>
        <script>
                $(document).ready(function(){
                    $("input").focus(function(){
                        $(this).siblings(".form-text").show();
                    }).blur(function(){
                        $(this).siblings(".form-text").hide();
                    });

                    $("#frm-producto").submit(function(event){
                        var isValid = true;

                        // Validar cada campo individualmente
                        $("input").each(function(){
                            var $this = $(this);
                            var value = $this.val();
                            var validationType = $this.data("validacion-tipo");

                            if(validationType.includes("requerido") && value.trim() === ""){
                                isValid = false;
                                alert("El campo " + $this.attr("name") + " es requerido.");
                            }
                        
                        });

                        if(!isValid){
                            event.preventDefault();
                        }
                    });
                });
        </script>
    </div>
</div>

