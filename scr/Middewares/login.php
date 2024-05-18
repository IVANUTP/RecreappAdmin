<?php
session_start();

// Función para generar un token de sesión único
function generateSessionToken() {
    return md5(uniqid(rand(), true));
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recreapp";

$conn = new mysqli($servername, $username, $password, $dbname);
 
// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
// Consulta para verificar las credenciales del usuario
$sql = "SELECT id, nombre, rol_id, password FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si se encontró un usuario con el correo electrónico proporcionado
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    // Verifica si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
    if (password_verify($password, $stored_password)) {
        // Inicio de sesión exitoso
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['nombre'];
        $_SESSION['rol_id'] = $row['rol_id']; // Agregar el rol del usuario a la sesión
        $_SESSION['session_token'] = generateSessionToken(); // Genera un token de sesión único

        // Redireccionar al panel de control según el rol del usuario
        if ($_SESSION['rol_id'] == 1) { // Si el rol es administrador
            header("Location: ../Views/admin/clientes.php?user_id=" . $_SESSION['user_id']);
        } elseif ($_SESSION['rol_id'] == 2) { // Si el rol es proveedor
            header("Location: ../Views/admin/inventario.php?user_id=" . $_SESSION['user_id']);
        } elseif ($_SESSION['rol_id'] == 3) { // Si el rol es gerente
            header("Location: ../Views/admin/clientes.php?user_id=" . $_SESSION['user_id']);
        } else {
            // Si el rol no es ninguno de los especificados, redirigir a la página 403.php
            header("Location: ../Views/admin/404.php");
        }
        exit();
    }
}

// Si el inicio de sesión falla, redirige a la página de inicio con un modal de error
header("Location: ../Views/index.php?modal=error");
exit();

