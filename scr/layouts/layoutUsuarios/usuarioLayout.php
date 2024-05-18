<style>
    .search-container {
    margin-top: 20px; /* Espacio entre la tabla y el campo de búsqueda */
    display: flex;
    justify-content: flex-end; /* Alinea el contenido a la derecha */
}

/* Estilos adicionales para el campo de búsqueda si es necesario */
#buscador {
    width: 200px; /* Ancho del campo de búsqueda */
}
</style>
<br>
<div class="container">
<div class="search-container">
        <input id="buscador" type="text" class="form-control" placeholder="Buscar">
    </div>
    <br>
    <table class="table-responsive table-striped table-hover" >
      <thead class="thead-green">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaUsers">
            <?php 
            require_once '../../Controllers/adminController/usuarios.php';
            $usuario=usuariosController::mostrarUsuarios();
            
            // Definir el tamaño de página y obtener el número total de elementos
            $pageSize = 5;
            $totalUsuarios = count($usuario);

            // Calcular el número total de páginas
            $totalPaginas = ceil($totalUsuarios / $pageSize);

            // Obtener la página actual del parámetro de consulta o predeterminar a 1
            $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            // Calcular el índice de inicio y fin para la página actual
            $inicio = ($paginaActual - 1) * $pageSize;
            $fin = $inicio + $pageSize;

            // Mostrar solo los elementos de la página actual
            for ($i = $inicio; $i < $fin && $i < $totalUsuarios; $i++) {
                $user = $usuario[$i];
                echo "<tr>";
                echo "<td>" . $user->nombre . "</td>";
                echo "<td>" . $user->email . "</td>";
                echo "<td>" . $user->password . "</td>";
                echo "<td>" . $user->nombre_rol . "</td>";
                echo "<td>";
                echo "<div style='display:flex; align-items: center;'>"; // Añadido align-items: center; para alinear verticalmente los elementos
                echo "<form action='../../Controllers/adminController/usuarios.php' method='post'>";
                echo "<input type='hidden' name='action' value='delete'>";
                echo "<input type='hidden' name='id' value='$user->id'>"; // Asegúrate de que $productoActual tenga una propiedad 'id'
                echo "<button type='submit' class='btn btn-danger' style='margin-right: 5px;'>Eliminar</button>"; // Agregada una pequeña separación con margin-right
                echo "</form>";
                echo "<button type='button' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#updateModal$user->id'>Actualizar</button>"; // Añadido data-bs-toggle y data-bs-target para abrir el modal correspondiente al producto
                echo "</div>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            
                echo "<div class='modal fade' id='updateModal$user->id' tabindex='-1' aria-labelledby='updateModalLabel$user->id' aria-hidden='true'>";
                echo "<div class='modal-dialog'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='updateModalLabel$user->id'>Actualizar Usuario</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                // Aquí va el formulario con los datos del usuario correspondiente
                echo "<form action='../../Controllers/adminController/usuarios.php' method='post' enctype='multipart/form-data' class='d-inline'>";
                echo "<input type='hidden' name='action' value='update'>"; // Campo oculto para indicar la acción
                echo "<input type='hidden' name='id' value='$user->id'>"; 
                echo "<div class='row'>";
                echo "<div class='col-md-6'>";
                echo "<div class='input-group mb-3'>";
                echo "<span class='input-group-text'>";
                echo "<i class='bi bi-person'></i>";
                echo "</span>";
                echo "<input type='text' name='nombreU' class='form-control' placeholder='Nombre del Usuario' aria-label='nombreU' aria-describedby='basic-addon1' value='$user->nombre' required>";
                echo "</div>";
                // Agrega los demás campos del formulario con los valores correspondientes del usuario
                echo "</div>";
                echo "<div class='col-md-6'>";
                echo "<div class='input-group mb-3'>";
                echo "<span class='input-group-text'>";
                echo "<i class='bi bi-envelope'></i>";
                echo "</span>";
                echo "<input type='text' name='correoU' class='form-control' placeholder='Correo' aria-label='correoU' aria-describedby='basic-addon1' value='$user->email' required>";
                echo "</div>";
                // Agrega los demás campos del formulario con los valores correspondientes del usuario
                echo "</div>";
                echo "</div>";
                echo "<div class='input-group mb-3'>";
                echo "<span class='input-group-text'>";
                echo "<i class='bi bi-person'></i>";
                echo "</span>";
                echo "<input type='text' class='form-control' placeholder='Rol' aria-label='Rol' aria-describedby='basic-addon1' value='$user->nombre_rol' readonly>";
                echo "</div>";
            
                // Agrega los demás campos del formulario con los valores correspondientes del usuario
                // Agrega los demás campos del formulario con los valores correspondientes del usuario
            
                echo "<div class='text-center'>"; // Contenedor para centrar el contenido
                echo "<button type='submit' class='btn btn-secondary m-2' style='background-color: #406DFF'>Actualizar</button>";
                echo "<button type='button' class='btn btn-danger m-2' data-bs-dismiss='modal'>Cancelar</button>";
                echo "</div>"; // Cierre del contenedor
                echo "</form>";
                // Agrega los demás campos del formulario con los valores correspondientes del usuario
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            
            
            
            
            ?>
        </tbody>
        

    </table>
    <br>
    
    <nav aria-label="Page navigation example  ">
    <ul class="pagination">
        <?php
        // Mostrar enlaces de paginación
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $url = "?pagina=$i&user_id=" . $_SESSION['user_id']. "&token=" .$_SESSION['session_token'] ;
            echo "<li class='page-item " . ($paginaActual == $i ? 'active' : '') . "'><a class='page-link' href='$url'>$i</a></li>";
        }
        ?>
    </ul>
</nav>
</div>
<br>
<br>
<?php include '../../Components/ModalUsuario.php' ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buscador = document.getElementById("buscador");
        const tablaProductos = document.getElementById("tablaUsers").getElementsByTagName("tr");

        buscador.addEventListener("input", function() {
            const terminoBusqueda = buscador.value.trim().toLowerCase();

            for (let i = 0; i < tablaProductos.length; i++) {
                const fila = tablaProductos[i];
                let encontrado = false;

                // Iterar sobre las celdas de la fila actual
                for (let j = 0; j < fila.cells.length; j++) {
                    const celda = fila.cells[j];
                    const textoCelda = celda.textContent.trim().toLowerCase();

                    // Verificar si el texto de la celda contiene el término de búsqueda
                    if (textoCelda.includes(terminoBusqueda)) {
                        encontrado = true;
                        break; // Terminar de buscar en esta fila
                    }
                }

                // Mostrar u ocultar la fila según si se encontró o no el término de búsqueda
                fila.style.display = encontrado ? "" : "none";
            }
        });
    });
</script>