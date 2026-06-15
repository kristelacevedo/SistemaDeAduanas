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
    // Código para guardar una nueva persona desde el modal
    $('#form_guardar_persona').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'ajax/buscar_personas.php?action=insertar', // Puedes procesarlo en el mismo archivo o crear otro
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#btn_guardar').attr("disabled", true).html("Guardando...");
            },
            success: function(response) {
                // Aquí asumirías que procesas el insert con éxito
                $('#mensaje_modal_persona').html('<div class="alert alert-success">Persona registrada con éxito.</div>');
                $('#form_guardar_persona')[0].reset(); // Limpiar campos
                $('#btn_guardar').attr("disabled", false).html("Guardar Persona");
                
                // Recargar la tabla si la función load() existe en la vista actual
                if (typeof load === "function") { load(1); }
                
                // Cerrar modal automáticamente en 1.5 segundos
                setTimeout(function(){
                    $('#modalRegistroPersona').modal('hide');
                    $('#mensaje_modal_persona').html('');
                }, 1500);
            },
            error: function() {
                alert("Error crítico en el servidor al intentar guardar.");
                $('#btn_guardar').attr("disabled", false).html("Guardar Persona");
            }
        });
    });

});