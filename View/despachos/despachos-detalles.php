<?php
require_once 'model/categorias.php';
require_once 'model/producto.php';
?>
<script>
    $(document).ready(function() {
        $("#buscador").on("input", function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "http://localhost/Sistemainventario/buscador.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#nombre").val(data.nombre);
                        $("#id_producto").val(data.id);
                        $("#disponible").val(data.cantidad);
                        $("#estado").val(data.estado);
                        $("#presentacion").val(data.presentacion);
                        $("#cantidad").attr("max", data.cantidad);
                    }
                });
            }
        });
    });
</script>
<div class="miga-de-pan">
    <a href="http://localhost/Sistemainventario/dashboard">Inicio</a> / <a href="http://localhost/Sistemainventario/entradas">Entradas</a> / <span>Detalle</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
            <form id="frm-compras" action="http://localhost/Sistemainventario/salidas/GuardarDetalles" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_despacho" value="<?= $id_comp ?>">
                <input type="hidden" id="id_producto" name="id_producto">
                <input type="hidden" id="disponible" name="disponible">
                <div class="form-group">
                    <label class="form_label" for="buscador">Buscador:</label>
                    <input type="text" id="buscador" name="buscador" class="form_input" placeholder="Buscar producto" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el nombre del producto."><br><br>
                </div>
                
                <div class="form-group">
                    <label class="form_label" for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form_input" readonly style="border:none;"><br>

                    <label class="form_label" for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" class="form_input" readonly style="border:none;"><br>

                    <label class="form_label" for="presentacion">Presentación:</label>
                    <input type="text" id="presentacion" name="presentacion" class="form_input" readonly style="border:none;"><br>
                </div>
                <div class="form-group">
                    <label class="form_label" for="cantidad">Cantidad a agregar:</label>
                    <input type="number" id="cantidad" min="0" name="cantidad" class="form_input" placeholder="Cantidad" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la cantidad."><br>
                </div>
                <div class="form-group full-width">
                    <input type="submit" class="btn btn-success" id="btn-guardar" value="Continuar">
                </div>
            </form>

            <script>
                document.getElementById('frm-compras').addEventListener('submit', function(event) {
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
            <a type="submit" href="http://localhost/Sistemainventario/salidas" class="btn" style="margin-bottom: 30px;">Finalizar</a>
            <table id="tabla" class="display">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $productos = new producto();
                    foreach ($this->model->ListarDestalles($id_comp) as $r):
                        $pro = $productos->Obtener($r->producto_id);
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $pro->nombre; ?></td>
                            <td><?php echo $r->cantidad; ?></td>
                            <td>
                                <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="http://localhost/Sistemainventario/salidas/EliminarDetalle/<?php echo $r->id; ?>/<?php echo $id_comp; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php $count++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>