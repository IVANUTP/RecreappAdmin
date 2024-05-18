<?php
// Verificar si la sesión está activa antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Verificar si el usuario está autenticado antes de permitir el acceso a la página
function verificarSesion() {
  if (!isset($_SESSION['user_id'])) {
      header("Location: ../../Views/admin/404.php"); // Redirigir al 404 si la sesión no está activa
      exit();
  }
}

// Llama a esta función al principio de tus scripts PHP donde sea necesario verificar la sesión
verificarSesion();

require_once '../../BaseDatos/conex.php';
require_once '../../Models/ClientesModel.php';

class ClientesController {
    public static function ObtenerClientes() {
        $conex = Conex::conexion();
        $sql = "SELECT id_usu, nombre, email, contra FROM  usuarios";
        $result = $conex->query($sql);

        $clientes = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientes[] = new Clientes($row['id_usu'], $row['nombre'], $row['email'], $row['contra']);
            }
        } else {
            echo "0 resultados";
        }
        $conex->close();
        return $clientes;
    }

    public static function eliminarCliente($idCliente) {
        verificarSesion(); // Verificar la sesión antes de ejecutar la acción

        $conex = Conex::conexion();
        $sql = "DELETE FROM usuarios WHERE id_usu = $idCliente";

        if ($conex->query($sql) === TRUE) {
            $_SESSION['insert_success'] = true;
            header("Location: ../../Views/admin/clientes.php?modal=success");
            exit();
        } else {
            header("Location: ../../Views/admin/clientes.php?modal=error&message=" . urlencode("Hubo un error al intentar insertar el nuevo producto: " . $conex->error));
            echo "Error al eliminar el cliente: " . $conex->error;
            exit();
        }

        $conex->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = $_POST["cliente_id"];

    ClientesController::eliminarCliente($idCliente);
}
