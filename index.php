<?php
session_start();
require_once 'model/database.php';

$controladorPorDefecto = 'dashboard';

if (!isset($_SESSION['user_nombre'])) {
    header('Location: login.php');
    exit;
}

// Obtener la URL amigable
$url = isset($_GET['url']) ? $_GET['url'] : $controladorPorDefecto;
$url = rtrim($url, '/');
$url = explode('/', $url);

$controlador = isset($url[0]) ? strtolower($url[0]) : $controladorPorDefecto;
$accion = isset($url[1]) ? $url[1] : 'Index';
$rif = isset($url[2]) ? $url[2] : null;

require_once "controller/$controlador.controller.php";
$nombreClaseControlador = ucwords($controlador) . 'Controller';
$instanciaControlador = new $nombreClaseControlador;

call_user_func(array($instanciaControlador, $accion), $rif);
?>
