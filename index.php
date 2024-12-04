<?php
session_start();
// Incluye la configuración de conexión a la base de datos
require_once 'model/database.php';

// Establece el controlador por defecto (por ejemplo, 'proveedor')
$controladorPorDefecto = 'dashboard';
// Verifica si el usuario está logueado (puedes personalizar esta lógica)
if (!isset($_SESSION['user_nombre'])) {
    // Redirige al formulario de inicio de sesión
    header('Location: login.php');
    exit; // Detiene la ejecución adicional
}

// Determina el controlador solicitado
$controlador = isset($_REQUEST['c']) ? strtolower($_REQUEST['c']) : $controladorPorDefecto;
$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
$rif = isset($_REQUEST['rif']) ? $_REQUEST['rif'] : null;

// Instancia el controlador
require_once "controller/$controlador.controller.php";
$nombreClaseControlador = ucwords($controlador) . 'Controller';
$instanciaControlador = new $nombreClaseControlador;

// Llama a la acción especificada
call_user_func(array($instanciaControlador, $accion), $rif);
?>
