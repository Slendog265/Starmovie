$(document).ready(function() {
    $('#customFile2').on('change', function() {
        var inputFile = this.files[0];
        if (!inputFile) return;

        var formData = new FormData();
        formData.append('file', inputFile);

        $.ajax({
            type: 'POST',
            url: 'backend/php/cambiar_foto_perfil.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert(response.message || 'No se pudo actualizar la foto.');
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                alert(response && response.message ? response.message : 'Error al enviar la imagen.');
            }
        });
    });
});