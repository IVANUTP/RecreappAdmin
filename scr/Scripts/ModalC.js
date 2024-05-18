document.addEventListener("DOMContentLoaded", function() {
    var urlParams = new URLSearchParams(window.location.search);
    var modalType = urlParams.get('modal');
    if (modalType === 'success') {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
    } else if (modalType === 'error') {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
        // También puedes mostrar el mensaje de error aquí si lo deseas
        var errorMessage = urlParams.get('message');
        console.error("Error al Inciar sesion :", errorMessage);
    }
});