// --- CONTROLADOR DE PERSONAS ---
    if ($("#tabla_personas").length) {
        cargarPersonas();
        $("#buscar_persona").on('keyup', cargarPersonas);
    }

    function cargarPersonas() {
        let q = $("#buscar_persona").val() || '';
        $.getJSON('ajax/buscar_personas.php', { action: 'buscar', q: q }, function(response) {
            if (response.status === 'success') {
                let filas = '';
                if (response.data.length === 0) {
                    filas = '<tr><td colspan="5" class="text-center text-muted py-3">No hay personas registradas.</td></tr>';
                } else {
                    response.data.forEach(p => {
                        filas += `<tr>
                            <td>${p.id_persona}</td>
                            <td><strong>${p.documento}</strong></td>
                            <td>${p.nombre} ${p.apellido}</td>
                            <td>${p.telefono || 'N/A'}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" onclick="editarPersona(${p.id_persona})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" onclick="eliminarPersona(${p.id_persona})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>`;
                    });
                }
                $("#tabla_personas").html(filas);
            }
        });
    }

    // Funcionalidad del formulario (Crear / Editar)
    $('#form_guardar_persona').on('submit', function(e) {
        e.preventDefault();
        $.post('ajax/buscar_personas.php?action=guardar', $(this).serialize(), function(response) {
            if (response.status === 'success') {
                $('#mensaje_modal_persona').html(`<div class="alert alert-success">${response.message}</div>`);
                cargarPersonas();
                setTimeout(() => { 
                    $('#modalRegistroPersona').modal('hide'); 
                    $('#mensaje_modal_persona').empty(); 
                    $('#form_guardar_persona')[0].reset();
                    $('#id_persona').val(''); // Limpiamos el ID oculto
                }, 1200);
            } else {
                $('#mensaje_modal_persona').html(`<div class="alert alert-danger">${response.message}</div>`);
            }
        }, 'json');
    });

    // Resetear el modal cuando se abre manualmente para agregar una nueva persona
    $('#modalRegistroPersona').on('hidden.bs.modal', function () {
        $('#form_guardar_persona')[0].reset();
        $('#id_persona').val('');
        $('#mensaje_modal_persona').empty();
        $('#modalLabel').html('<i class="fas fa-user-edit"></i> Registrar Nueva Persona');
    });

    // Función Global para Editar
    window.editarPersona = function(id) {
        $.getJSON('ajax/buscar_personas.php', { action: 'obtener', id: id }, function(response) {
            if (response.status === 'success') {
                // Llenar el formulario
                $('#id_persona').val(response.data.id_persona);
                $('#documento').val(response.data.documento);
                $('#nombre').val(response.data.nombre);
                $('#apellido').val(response.data.apellido);
                $('#telefono').val(response.data.telefono);
                
                // Cambiar el título del modal y mostrarlo
                $('#modalLabel').html('<i class="fas fa-user-edit"></i> Editar Persona');
                $('#modalRegistroPersona').modal('show');
            } else {
                alert(response.message);
            }
        });
    };

    // Función Global para Eliminar
    window.eliminarPersona = function(id) {
        if (confirm('¿Estás seguro de que deseas eliminar a esta persona? Esto no se puede deshacer.')) {
            $.post('ajax/buscar_personas.php?action=eliminar', { id: id }, function(response) {
                if (response.status === 'success') {
                    cargarPersonas();
                } else {
                    alert(response.message);
                }
            }, 'json');
        }
    };