<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Usuario no autenticado, redirige a la página de inicio de sesión
    header("Location: ../Views/index.php");
    exit();
}