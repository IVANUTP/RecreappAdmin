<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container  text-center">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Aviso</strong></h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se mostrará el mensaje de éxito/error -->
                <!--<div class="container text-center">
                    <p>El producto se agregó correctamente.</p>
                </div>-->
                
                <?php
                // Verificar si se ha configurado la variable de sesión insert_success y es true
                if (isset($_SESSION['insert_success']) && $_SESSION['insert_success']) {
                    echo "<div class='container text-center'";
                    echo"<P>El producto se agregó correctamente.</p>";
                    echo "</div>";
                } elseif (isset($_GET['modal']) && $_GET['modal'] === 'error') {
                    $modal_type = 'error'; // Tipo de modal (success o error)
                    $modal_title = "Error al insertar usuario";
                    $modal_body = urldecode($_GET['message']);
                }
                ?>
            </div>
            <div class="modal-footer">
                <button style="text-aling:center;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para éxito al eliminar -->
<!-- Modal para éxito al eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container text-center">
                     <h5 class="modal-title" id="deleteModalLabel">Producto Eliminado</h5>
                </div>
               
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                   El producto se ha eliminado correctamente.
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para éxito al actualizar -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container text-center">
                    <h5 class="modal-title" id="updateModalLabel">Producto Actualizado</h5>
                </div>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                El producto se ha actualizado correctamente.
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>


<script src="../../Scripts/ModalPro.js"></script>