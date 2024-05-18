<?php
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
   
   require_once "../../BaseDatos/conex.php";
   require_once "../../Models/ProductosModel.php";


   class ProductosController{
     
    public static function mostrarProductos(){
        
        $conex=Conex::conexion();

        $sql="SELECT id ,nombre, marca, modelo, precio, descripcion, img FROM productosprove";
        $result=$conex->query($sql);

        $prductos=array();

        if($result->num_rows>0){
           while($row=$result->fetch_assoc()){
               
              $prductos[]=new Productos($row['id'],$row['nombre'],$row['marca'],$row['modelo'],$row['precio'],$row['descripcion'],$row['img']);

           }
        }else{
            "0 Resultados";
        }
        $conex->close();
        return $prductos;
    }
    public static function insertProduct($nombre, $marca, $provedor, $modelo, $img, $precio, $sucursal, $fecha, $descripcion) {
        $conex = Conex::conexion();

        // Verificar si se ha subido una imagen
        if (!empty($img)) {
            // Escapar los valores para prevenir la inyección SQL
            $nombre = $conex->real_escape_string($nombre);
            $marca = $conex->real_escape_string($marca);
            $provedor = $conex->real_escape_string($provedor);
            $modelo = $conex->real_escape_string($modelo);
            $precio = $conex->real_escape_string($precio);
            $sucursal = $conex->real_escape_string($sucursal);
            $fecha = $conex->real_escape_string($fecha);
            $descripcion = $conex->real_escape_string($descripcion);

            // Convertir la imagen a base64
            $img_base64 = base64_encode(file_get_contents($img));

            // Insertar el registro en la base de datos
            $sql = "INSERT INTO productosprove (nombre, provedor, modelo, marca, sucursal, fecha, precio, img, descripcion) VALUES ('$nombre', '$provedor', '$modelo', '$marca', '$sucursal', '$fecha', '$precio', '$img_base64', '$descripcion')";

            if ($conex->query($sql) === TRUE) {
                $_SESSION['insert_success'] = true;
                header("Location: ../../Views/admin/inventario.php?modal=success"); // Redireccionar con modal de éxito
                exit();
            } else {
                header("Location: ../../Views/admin/inventario.php?modal=error&message=" . urlencode("Hubo un error al intentar insertar el nuevo producto: " . $conex->error)); // Redireccionar con modal de error
                exit();
            }
        } else {
            // Si no se subió ninguna imagen, mostrar un mensaje de error
            header("Location: ../../Views/admin/inventario.php?modal=error&message=" . urlencode("Debe seleccionar una imagen.")); // Redireccionar con modal de error
            exit();
        }

        $conex->close();
    }

    public static function eliminarProducto($idPro) {
        $conex = Conex::conexion();

        // Verificar si se proporcionó un ID válido
        if (!empty($idPro)) {
            // Aquí debes ajustar la consulta SQL para eliminar el producto con el ID proporcionado
            $sql = "DELETE FROM productosprove WHERE id = $idPro";

            if ($conex->query($sql) === TRUE) {
                $_SESSION['delete_success'] = true;
                header("Location: ../../Views/admin/inventario.php?modal=delete_success");// Redireccionar con modal de éxito
                exit();
            } else {
                // Si hay algún error durante la eliminación
                header("Location: ../../Views/admin/inventario.php?modal=error&message=" . urlencode("Hubo un error al intentar eliminar el producto: " . $conex->error)); // Redireccionar con modal de error
                exit();
            }
        } else {
            // Si no se proporcionó un ID válido, mostrar un mensaje de error
            header("Location: ../../Views/admin/inventario.php?modal=error&message=" . urlencode("ID de producto no válido.")); // Redireccionar con modal de error
            exit();
        }

        $conex->close();
    }
    public static function actualizarProducto($id, $nombre, $marca, $modelo, $precio, $descripcion) {
        $conex = Conex::conexion();
    
        // Escapar los valores para prevenir la inyección SQL
        $nombre = $conex->real_escape_string($nombre);
        $marca = $conex->real_escape_string($marca);
        $modelo = $conex->real_escape_string($modelo);
        $precio = $conex->real_escape_string($precio);
        $descripcion = $conex->real_escape_string($descripcion);
    
        // Actualizar el registro en la base de datos
        $sql = "UPDATE productosprove SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', precio = '$precio', descripcion = '$descripcion' WHERE id = $id";
    
        if ($conex->query($sql) === TRUE) {
            $_SESSION['update_success'] = true;
            header("Location: ../../Views/admin/inventario.php?modal=update_success"); // Redireccionar con modal de éxito
            exit();
        } else {
            // Si hay algún error durante la actualización
            header("Location: ../../Views/admin/inventario.php?modal=error&message=" . urlencode("Hubo un error al intentar actualizar el producto: " . $conex->error)); // Redireccionar con modal de error
            exit();
        }
    
        $conex->close();
    }
    

    // Otras funciones del controlador...
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        if ($action === "insert") {
            // Si la acción es insertar, llamar a la función insertProduct()
            $nombre = $_POST["nombre"];
            $marca = $_POST["marca"];
            $provedor = $_POST["provedor"];
            $modelo = $_POST["modelo"];
            $img = $_FILES["img"]["tmp_name"];
            $precio = $_POST["precio"];
            $sucursal = $_POST["sucursal"];
            $fecha = $_POST["fecha"];
            $descripcion = $_POST["descripcion"];
            ProductosController::insertProduct($nombre, $marca, $provedor, $modelo, $img, $precio, $sucursal, $fecha, $descripcion);
        } elseif ($action === "update") {
            // Si la acción es actualizar, llamar a la función actualizarProducto()
            $idu = $_POST["id"];
            $nombreu = $_POST["nombreU"];
            $marcau = $_POST["marcaU"];
            $modelou = $_POST["modeloU"];
            $preciou = $_POST["precioU"];
            $descripcionu = $_POST["descripcionU"];
            ProductosController::actualizarProducto($idu, $nombreu, $marcau, $modelou, $preciou, $descripcionu);
        } elseif ($action === "delete") {
            // Si la acción es eliminar, llamar a la función eliminarProducto()
            $idPro = $_POST["id"];
            ProductosController::eliminarProducto($idPro);
        }
    }

}
  
