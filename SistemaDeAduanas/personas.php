<?php
// personas.php
require_once("config/conexion.php");
include("head.php");
include("navbar.php");
?>

<div class="container mt-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2><i class="fas fa-users text-primary"></i> Control de Personas</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistroPersona">
                <i class="fas fa-user-plus"></i> Agregar Persona
            </button>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control" id="buscar_persona" placeholder="Buscar por nombre, apellido o documento...">
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div id="loader" class="text-center py-4 d-none">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="text-muted mt-2">Cargando registros...</p>
            </div>
            <div id="tabla_personas"></div>
        </div>
    </div>
</div>

<?php 
// Incluimos el modal de registro que crearemos a continuación
include("modal/registro_personas.php"); 
include("footer.php"); 
?>

<script>
    $(document).ready(function() {
        // Cargar la tabla automáticamente al abrir la página
        load(1);

        // Escuchar cuando el usuario escribe en la barra de búsqueda
        $("#buscar_persona").keyup(function() {
            load(1);
        });
    });

    function load(page) {
        var q = $("#buscar_persona").val();
        $("#loader").removeClass("d-none");
        $.ajax({
            url: 'ajax/buscar_personas.php?action=ajax&page=' + page + '&q=' + q,
            beforeSend: function(objeto) {
                // Se puede poner algo aquí antes de enviar
            },
            success: function(data) {
                $("#tabla_personas").html(data);
                $("#loader").addClass("d-none");
            }
        })
    }
</script>