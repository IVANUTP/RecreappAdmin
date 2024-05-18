<?php
session_start();

// Destruye la sesión
session_unset();
session_destroy();

// Redirige siempre al index.php después de cerrar sesión
header("Location: ./index.php");
// Muestra un mensaje de sesión expirada y redirige al index.php
echo "tu sesion se ha expirado";
exit();
?>
