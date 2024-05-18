<div class="container">


  <button id="mostrarFormulario" class="btn btn-secondary" >Agregar Producto</button>

    <form id="formulario" action="../../Controllers/adminController/Products.php" method="post" enctype="multipart/form-data" class="d-none">                                
        <input type='hidden' name='action' value='insert'>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del Producto"
                        aria-label="producto" aria-describedby="basic-addon1" required >
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="text"name="marca" class="form-control" placeholder="Marca"
                        aria-label="marca" aria-describedby="basic-addon1" required >
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="text" name="modelo" class="form-control" placeholder="Modelo"
                        aria-label="modelo" aria-describedby="basic-addon1" required >
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="file" name="img" class="form-control" placeholder="Seleccione una Imagen "
                        aria-label="img" aria-describedby="basic-addon1" >
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="text" name="provedor" class="form-control" placeholder="provedor"
                        aria-label="provedor" aria-describedby="basic-addon1" required>
               </div>
            </div> 
            <div class="col-md-6">
                <div class="input-group mb-3">
                        <span class="input-group-text" >
                            <i class="bi bi-pencil"></i>
                        </span>
                        <input type="text" name="precio" class="form-control" placeholder="Precio"
                            aria-label="precio" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="text" name="sucursal" class="form-control" placeholder="Sucursal"
                        aria-label="sucursal" aria-describedby="basic-addon1" required >
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <input type="date" name="fecha" class="form-control" placeholder="fecha"
                        aria-label="fecha" aria-describedby="basic-addon1" required>
               </div>
               <div class="input-group mb-3">
                    <span class="input-group-text" >
                        <i class="bi bi-pencil"></i>
                    </span>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción"></textarea>
                    
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