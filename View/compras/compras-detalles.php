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
                    url: "buscador.php",
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
                    }
                });
            }
        });
    });
</script>
<div class="miga-de-pan">
    <a href="?c=dashboard">Inicio</a> / <a href="?c=entradas">Entradas</a> / <span>Detalle</span>
</div>
<div class="contenido">
    <!-- contenido desde aqui -->

    <div class="contenedor-3d">
        <div class="division">
            <!-- contenido -->
            <form id="frm-compras" action="?c=compras&a=GuardarDetalles" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_compra" value="<?= $_GET['i'] ?>">
                <input type="hidden" id="id_producto" name="id_producto">
                <input type="hidden" id="disponible" name="disponible">
                <div class="form-group">
                    <label class="form_label" for="buscador">Buscador:</label>
                    <input type="text" id="buscador" name="buscador" class="form_input" placeholder="Buscar producto" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese el nombre del producto."><br><br>
                </div>
                <div class="form-group">
                    <label class="form_label" for="cantidad">Cantidad a agregar:</label>
                    <input type="number" id="cantidad" min="0" name="cantidad" class="form_input" placeholder="Cantidad" data-validacion-tipo="requerido" data-tooltip="Por favor, ingrese la cantidad."><br>
                </div>
                <div class="form-group full-width">
                    <input type="submit" class="btn btn-success" id="btn-guardar" value="Continuar">
                </div>
                <div class="form-group">
                    <label class="form_label" for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form_input" readonly style="border:none;"><br>

                    <label class="form_label" for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" class="form_input" readonly style="border:none;"><br>

                    <label class="form_label" for="presentacion">Presentación:</label>
                    <input type="text" id="presentacion" name="presentacion" class="form_input" readonly style="border:none;"><br>
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

            <a type="submit" href="?c=compras" class="btn" style="margin-bottom: 30px;">Finalizar</a>
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
                    foreach ($this->model->ListarDestalles($_GET['i']) as $r):
                        $pro = $productos->Obtener($r->producto_id);
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $pro->nombre; ?></td>
                            <td><?php echo $r->cantidad; ?></td>
                            <td>
                                <a style="color: red; margin-left:10px;" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=compras&a=EliminarDetalle&id=<?php echo $r->id; ?>&i=<?php echo $_GET['i']; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php $count++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>