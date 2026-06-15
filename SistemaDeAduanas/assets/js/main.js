// assets/js/main.js
$(document).ready(function() {
    
    // Función para manejar el Login
    $('#formLogin').on('submit', function(e) {
        e.preventDefault(); // Evita que la página se recargue
        
        $.ajax({
            url: 'ajax/procesar_login.php',
            type: 'POST',
            data: $(this).serialize(), // Toma todos los datos del formulario
            dataType: 'json',
            beforeSend: function() {
                $('#mensaje_login').html('<div class="alert alert-info shadow-sm">Verificando credenciales...</div>');
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#mensaje_login').html('<div class="alert alert-success shadow-sm"><i class="fas fa-check-circle"></i> ' + response.message + '</div>');
                    // Redirigir al index después de 1 segundo
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1000);
                } else {
                    $('#mensaje_login').html('<div class="alert alert-danger shadow-sm"><i class="fas fa-exclamation-triangle"></i> ' + response.message + '</div>');
                }
            },
            error: function() {
                $('#mensaje_login').html('<div class="alert alert-danger shadow-sm">Error al conectar con el servidor.</div>');
            }
        });
    });

});