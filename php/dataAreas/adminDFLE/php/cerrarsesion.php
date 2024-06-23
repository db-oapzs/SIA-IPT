<?php
// Iniciar sesión
session_start();

// Destruir la sesión (cerrar sesión)
session_destroy();

// Redireccionar a la página de inicio
header("Location: ../../../../html/login.php");
exit();
?>
