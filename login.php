<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
    <link rel="stylesheet" href="assets/css/estilos_login.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Iniciar Sesión
                    </div>
                    <div class="card-body">
                        <form action="procesar_login.php" method="POST">
                            <div class="form-group">
                                <label for="correo">Correo Electrónico:</label>
                                <input type="email" class="form_input" id="correo" name="email" placeholder="Ingrese el correo" required>
                            </div>
                            <a href="procesar_login.php">jjjj</a>
                            <div class="form-group">
                                <label for="clave">Contraseña:</label>
                                <input type="password" class="form_input" id="clave" name="password" placeholder="Ingrese la contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vista/js/validarLogin.js"></script>
</body>
</html>
