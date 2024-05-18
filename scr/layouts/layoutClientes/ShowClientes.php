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
  <h3 class="text-center">Administración de Clientes</h3>
</div>
<div class="container">
    <div class="search-container">
        <input id="buscador" type="text" class="form-control" placeholder="Buscar">
    </div>
    <br>
    <table class="table-responsive">
        <thead class="thead-green">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="cliente">
            <?php 
            require_once '../../Controllers/adminController/Clients.php';
            $clientes = ClientesController::ObtenerClientes();

            // Definir el tamaño de página y obtener el número total de elementos
            $pageSize = 8;
            $totalClientes = count($clientes);

            // Calcular el número total de páginas
            $totalPaginas = ceil($totalClientes / $pageSize);

            // Obtener la página actual del parámetro de consulta o predeterminar a 1
            $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            // Calcular el índice de inicio y fin para la página actual
            $inicio = ($paginaActual - 1) * $pageSize;
            $fin = $inicio + $pageSize;

         // Mostrar solo los elementos de la página actual
        for ($i = $inicio; $i < $totalClientes && $i < $fin; $i++) {
            $cliente = $clientes[$i];
            echo "<tr>";
            echo "<td>" . $cliente->nombre . "</td>";
            echo "<td>" . $cliente->email . "</td>";
            echo "<td>" . $cliente->contra . "</td>";
            echo "<td>";
            echo "<form action='../../Controllers/adminController/Clients.php' method='post'>";
            echo "<input type='hidden' name='cliente_id' value='$cliente->id_usu'>";
            echo "<button type='submit' class='btn btn-danger'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
            ?>
        </tbody>
    </table>
<br>

    <!-- Paginación -->
    
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
<?php include '../../Components/ModalCliente.php' ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buscador = document.getElementById("buscador");
        const tablaProductos = document.getElementById("cliente").getElementsByTagName("tr");

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
<br>
<br>
