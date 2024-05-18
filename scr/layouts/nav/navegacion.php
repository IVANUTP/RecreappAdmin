<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Función para verificar si el usuario ha iniciado sesión
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_name']);
}   
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Recreapp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if(isLoggedIn()): ?>
                     <!-- Agregar el nombre del usuario autenticado -->
                     <li class="nav-item">
                        <span class="nav-link">Bienvenido, <?php echo $_SESSION['user_name']; ?></span>
                    </li>
                    <?php if($_SESSION['rol_id'] == 1): ?>
                        <!-- Si el usuario es administrador -->
                        <li class="nav-item">
                            <a class="nav-link" href="clientes.php<?php if(isset($_GET['token'])) echo '?user_id=' . $_SESSION['user_id']; ?>">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inventario.php<?php if(isset($_GET['token'])) echo '?user_id=' . $_SESSION['user_id']; ?>">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php<?php if(isset($_GET['token'])) echo '?user_id=' . $_SESSION['user_id']; ?>">Usuarios</a>
                        </li>
                    <?php elseif($_SESSION['rol_id'] == 2): ?>
                        <!-- Si el usuario es proveedor -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php if(isset($_GET['token'])) echo 'inventario.php?user_id=' . $_SESSION['user_id']; else echo 'inventario.php'; ?>">Inventario</a>
                        </li>
                    <?php elseif($_SESSION['rol_id'] == 3): ?>
                        <!-- Si el usuario es gerente -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php if(isset($_GET['token'])) echo 'clientes.php?user_id=' . $_SESSION['user_id']; else echo 'clientes.php'; ?>">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php if(isset($_GET['token'])) echo 'inventario.php?user_id=' . $_SESSION['user_id']; else echo 'inventario.php'; ?>">Inventario</a>
                        </li>
                    <?php endif; ?>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
