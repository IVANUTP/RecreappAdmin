<?php
function verificarSesion() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Views/index.php"); // Redirigir al index si la sesión no está activa
        exit();
    }
  }
   
?>