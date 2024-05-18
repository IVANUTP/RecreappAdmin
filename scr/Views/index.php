<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../Styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
   <br>
   <br>
   <br>
   <?php include '../layouts/layoutLogin/formLayout.php' ?>
   <br>
   <div class="text-center">
  <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal">
    Olvidaste tu Contraseña 
  </a>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Recuperar Contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="index.php" method="post">
         <input type="email" name="correo" class="form-control" placeholder="Introduzca su Correo ">
      </div>
      <div class="modal-footer">
        <div class=" container text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>    
        </div>
       </form>
      </div>
    </div>
  </div>
</div>


<?php
require_once '../BaseDatos/conex.php';

$conn = Conex::conexion();

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verifica si se ha enviado el formulario de recuperación de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge el correo electrónico del formulario
    $correo = $conn->real_escape_string($_POST['correo']); // Evita inyección SQL

    // Preparar la consulta SQL para obtener la contraseña del usuario
    $sql = "SELECT password FROM users WHERE email = '$correo'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
        // Verificar si se encontró un usuario con el correo proporcionado
        if ($result->num_rows > 0) {
            // Si se encontró un usuario, obtener la contraseña
            $row = $result->fetch_assoc();
            $contrasena_encriptada = $row["password"];

            // Desencriptar la contraseña si es necesario (en este caso, no hay necesidad de desencriptarla)
            $contrasena = $contrasena_encriptada;

            // Preparar el correo electrónico
            $para = $correo;
            $titulo = "Recuperación de Contraseña";
            $mensaje = "I was really intrigued by the funerary rituals depicted in the mural paintings. Observing how these ceremonies were conducted made me reflect on the significance of cultural traditions in various societies";
            $cabeceras = "From: garciafloresangel27@gmail.com\r\n" .
                         "Reply-To: garciafloresangel27@gmail.com\r\n" .
                         "X-Mailer: PHP/" . phpversion();

            // Enviar el correo electrónico
            $resultado = mail($para, $titulo, $mensaje, $cabeceras);

            // Verificar si el correo se envió correctamente
            if ($resultado) {
                echo "<script>alert('Se ha enviado tu contraseña por correo electrónico.')</script>";
            } else {
                echo "Error en el envío del correo.";
            }
        } else {
            echo "<script>alert('No se encontró ningún usuario con ese correo electrónico.')</script>";
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
}

// Cerrar la conexión con la base de datos
$conn->close();
?>



</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
