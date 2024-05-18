<?php
require_once '../../BaseDatos/conex.php';
require_once '../../Models/usuarios.php';
// Verificar si la sesión está activa antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  // Verificar si el usuario está autenticado antes de permitir el acceso a la página
  function verificarSesion() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../../Views/admin/404.php"); // Redirigir al index si la sesión no está activa
        exit();
    }
  }
  
  // Llama a esta función al principio de tus scripts PHP donde sea necesario verificar la sesión
  verificarSesion();

class usuariosController
{
    public static function mostrarUsuarios()
    {
        $conex = Conex::conexion();

        $sql = "SELECT u.id, u.nombre, u.email, u.password, r.nombre AS nombre_rol 
              FROM users AS u
              INNER JOIN roles AS r ON u.rol_id = r.id";

        $result = $conex->query($sql);

        $users = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = new Usuarios($row['id'],$row['nombre'], $row['email'], $row['password'], $row['nombre_rol']);
            }
        } else {
            echo "0 resultados";
        }

        $conex->close();
        return $users;
    }

    public static function insertarUsuario($nombre, $correo, $contraseña, $rol_id)
    {
        $conex = Conex::conexion();

        // Escapar los valores para prevenir inyección SQL
        $nombre = $conex->real_escape_string($nombre);
        $correo = $conex->real_escape_string($correo);
        $contraseña = $conex->real_escape_string($contraseña);
        $rol_id = $conex->real_escape_string($rol_id);

        // Encriptar la contraseña antes de almacenarla en la base de datos (opcional)
        $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nombre, email, password, rol_id) VALUES ('$nombre', '$correo', '$contraseña_encriptada', '$rol_id')";

        if ($conex->query($sql) === TRUE) {
            $_SESSION['insert_success'] = true;
            header("Location: ../../Views/admin/usuarios.php?modal=success"); // Redireccionar con modal de éxito
            exit();
        } else {
            header("Location: ../../Views/admin/usuarios.php?modal=error&message=" . urlencode("Hubo un error al intentar insertar el nuevo usuario: " . $conex->error)); // Redireccionar con modal de error
            exit();
        }
        

        $conex->close();
    }
    public static function actualizarUsuario($id, $nombre, $correo )
    {
        $conex = Conex::conexion();

        // Escapar los valores para prevenir inyección SQL
        $id = $conex->real_escape_string($id);
        $nombre = $conex->real_escape_string($nombre);
        $correo = $conex->real_escape_string($correo);
     

        // Encriptar la contraseña antes de almacenarla en la base de datos (opcional)
        //$contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET nombre = '$nombre', email = '$correo' WHERE id = '$id'";

        if ($conex->query($sql) === TRUE) {
            $_SESSION['update_success'] = true;
            header("Location: ../../Views/admin/usuarios.php?modal=update_success"); // Redireccionar con modal de éxito
            exit();
        } else {
            header("Location: ../../Views/admin/usuarios.php?modal=error&message=" . urlencode("Hubo un error al intentar actualizar el usuario: " . $conex->error)); // Redireccionar con modal de error
            exit();
        }

        $conex->close();
    }
    public static function eliminarUsuario($id)
    {
        $conex = Conex::conexion();

        // Escapar el valor para prevenir inyección SQL
        $id = $conex->real_escape_string($id);

        $sql = "DELETE FROM users WHERE id = '$id'";
        
        if ($conex->query($sql) === TRUE) {
            $_SESSION['delete_success'] = true;
            header("Location: ../../Views/admin/usuarios.php?modal=delete_success"); // Redireccionar con modal de éxito
            exit();
        } else {
            header("Location: ../../Views/admin/usuarios.php?modal=error&message=" . urlencode("Hubo un error al intentar eliminar el usuario: " . $conex->error)); // Redireccionar con modal de error
            exit();
        }

        $conex->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        if ($action === "insert") {
            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $contraseña = $_POST["contra"];
            $rol_id = $_POST["rol_id"];
        
            // Insertar el nuevo usuario
            usuariosController::insertarUsuario($nombre, $correo, $contraseña, $rol_id);
        } elseif ($action === "update") {
            $idu = $_POST["id"];
            $nombre = $_POST["nombreU"];
            $correo = $_POST["correoU"];
            $contraseña = $_POST["contraU"];
            

            // Actualizar el usuario
            usuariosController::actualizarUsuario($idu, $nombre, $correo, $contraseña,);
        } elseif ($action === "delete") {
            $ide = $_POST["id"];
            // Eliminar el usuario
            usuariosController::eliminarUsuario($ide);
        }
    }
}

