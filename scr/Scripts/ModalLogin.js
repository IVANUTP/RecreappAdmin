 // Mostrar el modal de error si el parámetro modal=error está presente en la URL
 document.addEventListener("DOMContentLoaded", function() {
    var urlParams = new URLSearchParams(window.location.search);
    var modalType = urlParams.get('modal');
    if (modalType === 'error') {
        var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
        myModal.show();
    }
});