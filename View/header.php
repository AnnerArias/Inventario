<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de Inventario</title>
    <link rel="stylesheet" href="http://localhost/Sistemainventario/assets/css/estilos.css">
    <link rel="stylesheet" href="http://localhost/Sistemainventario/assets/css/all.min.css" />
    <script src="http://localhost/Sistemainventario/assets/js/all.min.js"></script>
    <!-- alertfy -->
    <link rel="stylesheet" href="http://localhost/Sistemainventario/assets/css/alertify.min.css" />
    <link rel="stylesheet" href="http://localhost/Sistemainventario/assets/css/alertify-default.min.css" />
    <script src="http://localhost/Sistemainventario/assets/js/alertify.min.js"></script>

    <!-- data table -->
    <link rel="stylesheet" href="http://localhost/Sistemainventario/assets/css/dataTables.dataTables.min.css">
    <script src="http://localhost/Sistemainventario/assets/js/jquery-3.5.1.js"></script>
    <script src="http://localhost/Sistemainventario/assets/js/dataTables.min.js"></script>
    <!-- tooltip -->
    <link rel="stylesheet" href="http://localhost/Sistemainventario/assets/css/jquery-ui.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="http://localhost/Sistemainventario/assets/js/jquery-ui.js"></script>
    <script>
        $(function() {
            $(document).tooltip({
                items: "[data-tooltip]",
                content: function() {
                    return $(this).data("tooltip");
                }
            });
        });
    </script>
</head>

<body>
    <div class="barra-lateral" id="sidebar">
        <div class="logo">
            <img src="http://localhost/Sistemainventario/assets/img/logo.png" width="70px">
        </div>
        <ul class="menu">
            <a href="/Sistemainventario/dashboard" class="enlace-menu">
                <li><i class="fas fa-tachometer-alt"></i> <span style="margin-left: 10px;">Inicio</span></li>
            </a>
            <a href="/Sistemainventario/producto" class="enlace-menu">
                <li><i class="fas fa-box"></i> <span style="margin-left: 10px;">Productos</span></li>
            </a>
            <a href="/Sistemainventario/proveedor" class="enlace-menu">
                <li><i class="fas fa-truck"></i> <span style="margin-left: 10px;">Proveedores</span></li>
            </a>
            <a href="/Sistemainventario/categorias" class="enlace-menu">
                <li><i class="fas fa-tags"></i> <span style="margin-left: 10px;">Categorías</span></li>
            </a>
            <a href="/Sistemainventario/entradas" class="enlace-menu">
                <li><i class="fas fa-shopping-cart"></i> <span style="margin-left: 10px;">Entradas</span></li>
            </a>
            <a href="/Sistemainventario/salidas" class="enlace-menu">
                <li><i class="fas fa-dolly"></i> <span style="margin-left: 10px;">Salidas</span></li>
            </a>
            <a href="/Sistemainventario/almacen" class="enlace-menu">
                <li><i class="fas fa-warehouse"></i> <span style="margin-left: 10px;">Almacén</span></li>
            </a>
            <a href="/Sistemainventario/usuario" class="enlace-menu">
                <li><i class="fas fa-user"></i> <span style="margin-left: 10px;">Usuarios</span></li>
            </a>
        </ul>
    </div>
    <div class="contenido-principal">
        <div class="barra-superior">
            <button class="boton-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
            <div class="notificaciones" id="noti">
</div>

<script>
    function actualizarNotificaciones() {
        fetch('http://localhost/Sistemainventario/notificaciones.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('noti').innerHTML = data;
            })
            .catch(error => console.error('Error al obtener las notificaciones:', error));
    }

    // Actualizar las notificaciones cada segundo
    setInterval(actualizarNotificaciones, 1000);
</script>

            <div class="espacio"> <span><?= $_SESSION['user_nombre'] ?></span></div>
            <div class="info-usuario">
                <img src="http://localhost/Sistemainventario/assets/img/logo.png" alt="Usuario" class="user-img">
                <div class="desplegable">
                    <p><a href="http://localhost/Sistemainventario/usuario/CambioClave" style="text-decoration: none;">Cambio Clave</a></p>
                    <p><a href="salir.php" style="text-decoration: none;">Salir</a></p>
                </div>
            </div>
        </div>