<?php
// Inicia la sesión (si no está iniciada)
session_start();

// Destruye todas las variables de sesión
session_unset();

// Cierra la sesión
session_destroy();

// Redirige al formulario de inicio de sesión
header('Location: login.php');
exit;
?>
