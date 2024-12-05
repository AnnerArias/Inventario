<?php
require_once 'model/usuario.php';
?>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/entradas">Entradas</a> / <span>Crear nueva</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
        <form id="frm-producto" action="http://localhost/Sistemainventario/salidas/Guardar" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label class="form_label">Autorizado</label>
                    <select name="emisor_id" class="form_input">
                    <?php 
                        $user = new usuario;
                        foreach($user->Listar() as $r): 
                    ?>
                    <option value="<?=$r->id?>"><?=$r->nombres?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form_label">Fecha</label>
                    <input type="date" name="fecha" class="form_input" placeholder="Ingrese nombre producto" autofocus data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese la fecha de la factura.</small>
                </div>
                <div class="form-group">
                    <label class="form_label">Número de factura</label>
                    <input type="text" name="factura" class="form_input" placeholder="Ingrese presentación" data-validacion-tipo="requerido" />
                    <br><small class="form-text text-muted">Por favor, ingrese el número de la factura.</small>
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

