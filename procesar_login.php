<?php
session_start();

class AuthController {
    private $pdo; // Declara la variable $pdo

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=mvc_php", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['email'];
            $clave = md5($_POST['password']);

            // Realiza la consulta para verificar las credenciales
            $sql = "SELECT * FROM usuarios WHERE estado = 'Activo' AND (correo = :correo AND clave = :clave)";
            $stmt = $this->pdo->prepare($sql); // Usa $this->pdo
            $stmt->execute(['correo' => $correo, 'clave' => $clave]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                // Credenciales válidas: establece variables de sesión
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_nombre'] = $usuario['nombres'].', '.$usuario['apellidos'];
                $_SESSION['user_perfil'] = $usuario['rol'];
                $_SESSION['user_avatar'] = $usuario['avatar'];

                // Redirige al área privada o a la página principal
                header('Location: http://localhost/Sistemainventario/'); // Cambia la ruta según tu estructura
                exit;
            } else {
                // Credenciales inválidas: muestra un mensaje de error
                $_SESSION['login_error'] = 'Credenciales incorrectas. Inténtalo nuevamente.';
                header('Location: http://localhost/Sistemainventario/login.php'); // Redirige al formulario de inicio de sesión
                exit;
            }
        } else {
            // Si se accede directamente a este archivo, redirige al formulario de inicio de sesión
            header('Location: http://localhost/Sistemainventario/login.php');
            exit;
        }
    }
}

// Crea una instancia del controlador y procesa el inicio de sesión
$authController = new AuthController();
$authController->procesarLogin();
?>
