<link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Acomoda menú principal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ícono de Agregar -->
<?php
// Verificar si la sesión ya está activa
if (session_status() == PHP_SESSION_NONE) {
    // Si no está activa, la iniciamos
    session_start();
}

// Resto del código...
?>

<div class="container">
<button id="mostrarFormulario" class="btn btn-secondary">Insertar Usuario</button>
<form id="formulario" action="../../Controllers/adminController/usuarios.php" method="post" enctype="multipart/form-data" class="d-none">
                             
        <div class="row">
        <input type='hidden' name='action' value='insert'>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" >
                    <i class="bi bi-person-circle"></i>
                    </span>
                    <input id="nombre" type="text" class="form-control" placeholder="Nombre del Usuario"
                        aria-label="Username" aria-describedby="basic-addon1" name="nombre" required>
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                    <i class="bi bi-envelope"></i>
                    </span>
                    <input id="correo" type="email" class="form-control" placeholder="Correo"
                        aria-label="Correo" aria-describedby="basic-addon1" name="correo" required >
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                    <i class="bi bi-lock"></i>
                    </span>
                    <input id="contra" type="password" class="form-control" placeholder="Contraseña"
                        aria-label="Contraseña" aria-describedby="basic-addon1" name="contra"required >
               </div>
              
            </div> 
            <div class="col-md-6">
               
              
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-pencil"></i>
                </span>
                <select name="rol_id" class="form-select" id="roles" placeholder="rol" name="rol">
                    <?php 
                    require_once '../../Controllers/adminController/rolController.php';

                    // Llamar al método para obtener los roles
                    $roles = RolController::mostrarRol();

                    // Iterar sobre los roles para generar las opciones del selector
                    foreach ($roles as $rol) {
                        echo "<option value='" . $rol->id . "'>" . $rol->nombre . "</option>";
                    }
                    ?>
                </select>
            </div>
           

              
            </div>   
                  
        </div>                    
          <br>
          <br>
          <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-secondary" style="background-color: #406DFF">Agregar</button>
                  <div class="m-2"></div> <!-- Espacio entre los botones -->
                  <button type="button" id="cancelar" class="btn btn-danger">Cancelar</button>
          </div>
      </form>
</div>
<script>
    // Obtener referencias a los elementos del DOM
    const botonMostrarFormulario = document.getElementById('mostrarFormulario');
    const formulario = document.getElementById('formulario');
    const botonCancelar = document.getElementById('cancelar');

    // Agregar un evento de clic al botón para mostrar el formulario
    botonMostrarFormulario.addEventListener('click', function() {
        formulario.classList.remove('d-none'); // Mostrar el formulario
        botonMostrarFormulario.classList.add('d-none'); // Ocultar el botón "Mostrar Formulario"
    });

    // Agregar un evento de clic al botón "Cancelar" para ocultar el formulario
    botonCancelar.addEventListener('click', function() {
        formulario.classList.add('d-none'); // Ocultar el formulario
        botonMostrarFormulario.classList.remove('d-none'); // Mostrar el botón "Mostrar Formulario"
    });
</script>