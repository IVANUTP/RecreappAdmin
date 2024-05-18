<?php 

   require_once '../../Models/rolModel.php';
   require_once '../../BaseDatos/conex.php';

   class RolController {
    public static function mostrarRol() {
            $conex = Conex::conexion();

            $sql = "SELECT id, nombre FROM roles";

            $result = $conex->query($sql);

            $roles = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Crear una instancia de la clase Roles con el ID y el nombre del rol
                    $rol = new Roles($row['id'], $row['nombre']);
                    $roles[] = $rol;
                }
            } else {
                echo "0 resultados";
            }

            $conex->close();
            return $roles;
        }
    }

?>